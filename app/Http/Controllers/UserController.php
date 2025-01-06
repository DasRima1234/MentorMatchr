<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\EmailTemplateLang;
use App\Models\Lead;
use App\Models\Mdf;
use App\Models\Notification;
use App\Models\User;
use App\Models\UsersOperatorsServices;
use App\Models\Utility;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::user()->can('Manage Users')) {
            $user  = Auth::user();
            $users = User::where('created_by', '=', $user->ownerId())->where('type', '!=', 'Client')->get();

            return view('users.index', compact('users'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('Create User')) {
            $user = \Auth::user();
            if ($user->type == 'Super Admin') {
                return view('users.create');
            } else {
                $roles = Role::where('created_by', '=', $user->ownerId())->get();

                $customFields = CustomField::where('module', '=', 'user')->get();

                return view('users.create_owner', compact('roles', 'customFields'));
            }
        } else {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        // return $request;
        if (\Auth::user()->can('Create User')) {
            $objUser      = \Auth::user();
            $resp         = '';
            $default_lang = Utility::getValByName('default_language');

            if ($objUser->type == 'Super Admin') {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                        'password' => 'required',
                        'user_name' => 'required|unique:users',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('users')->with('error', $messages->first());
                }

                $user      = User::create(
                    [
                        'name' => $request->name,
                        'user_name' => $request->user_name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'type' => 'Owner',
                        'lang' => $default_lang,
                        'created_by' => \Auth::user()->id,
                    ]
                );
                $adminRole = Role::findByName('Owner');
                $user->assignRole($adminRole);
                //$user->assignPlan(1);
                $user->userDefaultData();
                $user->makeEmployeeRole();
            } else {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                        'confirm_password' => 'required',
                        'password' => 'required_with:confirm_password|same:confirm_password',
                        'role' => 'required',
                        'user_name' => 'required|unique:users',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('users')->with('error', $messages->first());
                }

                $role = Role::findById($request->role);
                $user = User::create(
                    [
                        'name' => $request->name,
                        'user_name' => $request->user_name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'type' => $role->name,
                        'created_by' => $objUser->ownerId(),
                        'lang' => $default_lang,
                    ]
                );
                $user->assignRole($role);

                CustomField::saveData($user, $request->customField);

                $uArr = [
                    'email' => $user->email,
                    'password' => $request->password,
                ];

                // Send Email
                //$resp = Utility::sendEmailTemplate('New User', [$user->id => $user->email], $uArr);
            }

            return redirect()->route('users')->with('success', __('User created Successfully!') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function show($id)
    {
        $user=User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        if (\Auth::user()->can('Edit User')) {
            $user = User::where('id', '=', $id)->where('created_by', '=', \Auth::user()->ownerId())->first();
            if ($user) {
                $objUser = \Auth::user();
                if ($objUser->type == 'Super Admin') {
                    return view('users.edit', compact('user'));
                } else {
                    $roles    = Role::where('created_by', '=', $user->ownerId())->get();
                   
                    $userRole = $user->roles->first();
                    if ($userRole) {
                        $userRole = $userRole->id;
                    } else {
                        $userRole = '';
                    }
                    $user->customField = CustomField::getData($user, 'user');
                
                    $customFields= CustomField::where('module', '=', 'user')->get();

                    return view('users.edit_owner', compact('roles', 'userRole', 'user', 'customFields'));
                }
            } else {
                return response()->json(['error' => __('Invalid User.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
        
    }

    public function update($id, Request $request)
    {
        if (\Auth::user()->can('Edit User')) {
            $user = User::where('id', '=', $id)->where('created_by', '=', \Auth::user()->ownerId())->first();
            if ($user) {

                $objUser = \Auth::user();
                if ($objUser->type == 'Super Admin') {
                    $validator = \Validator::make(
                        $request->all(),
                        [
                            'name' => 'required',
                            'email' => 'required|email|unique:users,email,' . $id,
                            'user_name' => 'required|unique:users,user_name,' . $id,
                            //    'confirm_password' => 'required',
                            //    'password' => 'required_with:confirm_password|same:confirm_password',

                        ]
                    );
                    // if($user->email != $request->email){

                    // }
                    if ($validator->fails()) {
                        $messages = $validator->getMessageBag();

                        return redirect()->route('users')->with('error', $messages->first());
                    }

                    $post         = [];
                    $post['name'] = $request->name;
                    if (!empty($request->password)) {
                        $validation['password'] = 'required';
                        $post['password']       = Hash::make($request->password);
                    }

                    $post['email'] = $request->email;

                    $user->update($post);
                } else {
                    $validator = \Validator::make(
                        $request->all(),
                        [
                            'name' => 'required',
                            'email' => 'required|email|unique:users,email,' . $id,
                            'role' => 'required',
                            'user_name' => 'required|unique:users,user_name,' . $id,
                            //    'confirm_password' => 'required',
                            //    'password' => 'required_with:confirm_password|same:confirm_password',
                        ]
                    );
                    if ($validator->fails()) {
                        $messages = $validator->getMessageBag();

                        return redirect()->route('users')->with('error', $messages->first());
                    }
                    // return $request;
                    $post         = [];
                    $post['name'] = $request->name;
                    // if(!empty($request->password))
                    // {
                    //     $validation['password'] = 'required';
                    //     $post['password']       = Hash::make($request->password);
                    // }
                    $post['user_name']     = $request->user_name;
                    $post['email']     = $request->email;
                    $post['type']      = Role::findById($request->role)->name;
                    $user->update($post);
                    $roles[] = $request->role;
                    $user->roles()->sync($roles);
                    CustomField::saveData($user, $request->customField);
                }

                return redirect()->route('users')->with('success', __('User Updated Successfully!'));
            } else {
                return redirect()->back()->with('error', __('Invalid User.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('Delete User')) {
            $user = User::where('id', '=', $id)->where('created_by', '=', \Auth::user()->ownerId())->first();
            if ($user) {
                
                $user->delete();

                return redirect()->route('users')->with('success', __('User Deleted Successfully!'));
            } else {
                return redirect()->back()->with('error', __('Invalid User.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function profile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    public function deleteAvatar()
    {
        $objUser = Auth::user();
        \File::delete(storage_path('avatars/' . $objUser->avatar));
        $objUser->avatar = '';
        $objUser->save();

        return redirect()->route('profile')->with('success', __('Avatar deleted successfully'));
    }

    public function updateProfile(Request $request)
    {
        $objUser             = Auth::user();
        $validation          = [];
        $validation['name']  = 'required';
        $validation['email'] = 'required|email|unique:users,email,' . Auth::user()->id;

        if ($request->avatar) {
            $validation['avatar'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($validation);

        $post = $request->all();
        if ($request->avatar) {
            \File::delete(storage_path('avatars/' . $objUser->avatar));
            $avatarName = $objUser->id . '_avatar' . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
            $post['avatar'] = $avatarName;
        }

        $objUser->update($post);

        return redirect()->back()->with('success', __('Profile Updated Successfully!'));
    }
    public function userpassword(Request $request)
    {
        if (Auth::Check()) {
            $request->validate(
                [
                    'old_password' => 'required',
                    'password' => 'required|same:password',
                    'password_confirmation' => 'required|same:password',
                ]
            );
            $objUser          = User::find($request->id);
            $request_data     = $request->All();
            $current_password = $objUser->password;

            if (Hash::check($request_data['old_password'], $current_password)) {
                $user_id            = Auth::User()->id;
                $obj_user           = User::find($request->id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();

                return redirect()->back()->with('success', __('Password Updated Successfully!'));
            } else {
                return redirect()->back()->with('error', __('Please Enter Correct Current Password!'));
            }
        } else {
            return redirect()->route('profile')->with('error', __('Something is wrong!'));
        }
    }
    public function updatePassword(Request $request)
    {
        if (Auth::Check()) {
            $request->validate(
                [
                    'old_password' => 'required',
                    'password' => 'required|same:password',
                    'password_confirmation' => 'required|same:password',
                ]
            );
            $objUser          = Auth::user();
            $request_data     = $request->All();
            $current_password = $objUser->password;

            if (Hash::check($request_data['old_password'], $current_password)) {
                $user_id            = Auth::User()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['password']);;
                $obj_user->save();

                return redirect()->route('profile')->with('success', __('Password Updated Successfully!'));
            } else {
                return redirect()->route('profile')->with('error', __('Please Enter Correct Current Password!'));
            }
        } else {
            return redirect()->route('profile')->with('error', __('Something is wrong!'));
        }
    }

    public function lang($currantLang)
    {
        if (\Auth::user()->can('Manage Languages')) {
            $user = \Auth::user();

            $dir = base_path() . '/resources/lang/' . $user->id . "/" . $currantLang;
            if (!is_dir($dir)) {
                $dir = base_path() . '/resources/lang/' . $currantLang;
                if (!is_dir($dir)) {
                    $dir = base_path() . '/resources/lang/en';
                }
            }
            $arrLabel = json_decode(file_get_contents($dir . '.json'));

            $arrFiles   = array_diff(
                scandir($dir),
                array(
                    '..',
                    '.',
                )
            );
            $arrMessage = [];
            foreach ($arrFiles as $file) {
                $fileName = basename($file, ".php");
                $fileData = $myArray = include $dir . "/" . $file;
                if (is_array($fileData)) {
                    $arrMessage[$fileName] = $fileData;
                }
            }

            return view('lang.index', compact('currantLang', 'arrLabel', 'arrMessage'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function createLang()
    {
        if (\Auth::user()->can('Create Language')) {
            return view('lang.create');
        } else {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function storeLang(Request $request)
    {
        if (\Auth::user()->can('Create Language')) {
            $Filesystem = new Filesystem();
            $langCode   = strtolower($request->code);
            $langDir    = base_path() . '/resources/lang/';
            $dir        = $langDir;
            if (!is_dir($dir)) {
                mkdir($dir);
                chmod($dir, 0777);
            }
            $dir      = $dir . '/' . $langCode;
            $jsonFile = $dir . ".json";
            \File::copy($langDir . 'en.json', $jsonFile);

            if (!is_dir($dir)) {
                mkdir($dir);
                chmod($dir, 0777);
            }
            $Filesystem->copyDirectory($langDir . "en", $dir . "/");

            // make entry in email_tempalte_lang table for email template content
            Utility::makeEmailLang($langCode);

            return redirect()->route('lang', $langCode)->with('success', __('Language Created Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function storeLangData($currantLang, Request $request)
    {
        if (\Auth::user()->can('Edit Language')) {
            //            $Filesystem = new Filesystem();
            $dir = base_path() . '/resources/lang';
            if (!is_dir($dir)) {
                mkdir($dir);
                chmod($dir, 0777);
            }
            $jsonFile = $dir . "/" . $currantLang . ".json";

            file_put_contents($jsonFile, json_encode($request->label));

            $langFolder = $dir . "/" . $currantLang;

            if (!is_dir($langFolder)) {
                mkdir($langFolder);
                chmod($langFolder, 0777);
            }

            if (!empty($request->message)) {
                foreach ($request->message as $fileName => $fileData) {
                    $content = "<?php return [";
                    $content .= $this->buildArray($fileData);
                    $content .= "];";
                    file_put_contents($langFolder . "/" . $fileName . '.php', $content);
                }
            }

            return redirect()->route('lang', $currantLang)->with('success', __('Language Save Successfully!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function destroyLang($lang)
    {
        $settings     = Utility::settings();
        $default_lang = $settings['default_language'];

        // Remove Email Template Language
        EmailTemplateLang::where('lang', 'LIKE', $lang)->delete();

        $langDir = base_path() . '/resources/lang/';

        if (is_dir($langDir)) {
            // remove directory and file
            Utility::delete_directory($langDir . $lang);
            unlink($langDir . $lang . '.json');

            // update user that has assign deleted language.
            User::where('lang', 'LIKE', $lang)->update(['lang' => $default_lang]);
        }

        return redirect()->route('lang', $default_lang)->with('success', __('Language Deleted Successfully!'));
    }

    public function buildArray($fileData)
    {
        $content = "";
        foreach ($fileData as $lable => $data) {
            if (is_array($data)) {
                $content .= "'$lable'=>[" . $this->buildArray($data) . "],";
            } else {
                $content .= "'$lable'=>'" . addslashes($data) . "',";
            }
        }

        return $content;
    }

    public function changeLang($lang)
    {
        $user       = \Auth::user();
        $user->lang = $lang;
        $user->save();

        return redirect()->back()->with('success', __('Language Change Successfully!'));
    }

    
    public function notificationSeen($user_id)
    {
        Notification::where('user_id', '=', $user_id)->update(['is_read' => 1]);

        return response()->json(['is_success' => true], 200);
    }
    public function error()
    {
        return view('users.error');
    }
    public function isactive($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'User ' . ($user->is_active ? 'Active' : 'Non-Active') . ' successfully.');
    }
}
