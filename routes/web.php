<?php

// use App\Http\Controllers\BranchController;

use App\Http\Controllers\Dashboard_V2_Controller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::group(['prefix' => 'admin'], function () {
Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::get('/register', function () {
    return redirect('/login');
});

Route::get('/', function () {
    return abort(404);
});

Route::get('/', ['as' => 'home', 'uses' => 'Dashboard_V2_Controller@index',])->middleware(['XSS']);

Route::get('/checkrevenue', 'AnalyticController@checkrevenue')->middleware(['auth', 'XSS',]);

Route::get('/home', ['as' => 'homes', 'uses' => 'Dashboard_V2_Controller@index',])->middleware(['auth', 'XSS',]);
Route::get('/check', 'HomeController@check')->middleware(['auth', 'XSS',]);

Route::get('/profile', ['as' => 'profile', 'uses' => 'UserController@profile',])->middleware(['auth', 'XSS',]);
Route::post('/profile', ['as' => 'update.profile', 'uses' => 'UserController@updateProfile',])->middleware(['auth', 'XSS',]);
Route::post('/profile/password', ['as' => 'update.password', 'uses' => 'UserController@updatePassword',])->middleware(['auth', 'XSS',]);
Route::delete('/profile', ['as' => 'delete.avatar', 'uses' => 'UserController@deleteAvatar',])->middleware(['auth', 'XSS',]);

Route::get('/users', ['as' => 'users', 'uses' => 'UserController@index',])->middleware(['auth', 'XSS',]);
Route::post('/users', ['as' => 'users.store', 'uses' => 'UserController@store',])->middleware(['auth', 'XSS',]);
Route::get('/users/create', ['as' => 'users.create', 'uses' => 'UserController@create',])->middleware(['auth', 'XSS',]);
Route::get('/users/edit/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit',])->middleware(['auth', 'XSS',]);
Route::get('/users/{id}', ['as' => 'users.show', 'uses' => 'UserController@show'])->middleware(['auth', 'XSS']);
Route::post('/users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update',])->middleware(['auth', 'XSS',]);
Route::delete('/users/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy',])->middleware(['auth', 'XSS',]);
Route::post('/userCreateFromCsv', ['as' => 'userCreateFromCsv', 'uses' => 'UserController@userCreateFromCsv',])->middleware(['auth', 'XSS',]);
Route::post('/profile/userpassword', ['as' => 'update.userpassword', 'uses' => 'UserController@userpassword',])->middleware(['auth', 'XSS',]);

Route::resource('students', 'StudentController');

Route::resource('roles', 'RoleController');
Route::prefix('roles')->middleware(['auth', 'XSS',])->group(function () {

    Route::get('/{id}/operator', 'RoleController@addOperator')->name('roles.operator')->middleware(['auth', 'XSS',]);
    Route::post('/operator/store', 'RoleController@storeOperator')->name('roles.operator.store')->middleware(['auth', 'XSS',]);
});
Route::resource('permissions', 'PermissionController');

/* Reports Web */

Route::prefix('dashboard')->middleware(['auth', 'XSS',])->group(function () {
    Route::get('/country', 'Dashboard_V2_Controller@index')->name('dashboard.country.tesing');
    Route::get('/operator', 'Dashboard_V2_Controller@operatorDashboard')->name('dashboard.operator');
    Route::get('/company', 'Dashboard_V2_Controller@companyDashboard')->name('dashboard.company');
    Route::get('/business', 'Dashboard_V2_Controller@businessDashboard')->name('dashboard.business');
    Route::post('/getsummarygraphdata', 'Controller@Getsummarygraphdata');
    Route::post('/getmixedgraphaxesdata', 'Controller@Getmixedgraphaxesdata');
    Route::post('/getmixedgraphdata', 'Controller@Getmixedgraphdata');
});
// Route::get('/dashboard', [Dashboard_V2_Controller::class, 'index'])->name('dashboard');

// Route::controller(Dashboard_V2_Controller::class)->group(function () {
//     Route::get('admin/dashboard', 'AdminAccess')->name('admin.dashboard');
    
// });
Route::get('/settings', ['as' => 'settings', 'uses' => 'SettingsController@index',])->middleware(['auth', 'XSS',]);
Route::post('/settings', ['as' => 'settings.store', 'uses' => 'SettingsController@store',])->middleware(['auth', 'XSS',]);


Route::prefix('management')->middleware(['auth', 'XSS',])->group(function () {
    Route::get('/user', 'ManagementController@userManagement')->name('management.user');
    Route::get('/users/{id}/operator/service', 'ManagementController@showUserOperator')->name('users.show.operator');
});

Route::get('/isactive/{id}', 'UserController@isactive')->name('user.isactive');

Route::get('/{uid}/notification/seen', ['as' => 'notification.seen', 'uses' => 'UserController@notificationSeen']);
/* fake Router */
Route::post('/message_data', 'SettingsController@savePaymentSettings')->name('message.data')->middleware(['auth', 'XSS']);

Route::post('/message_seen', 'SettingsController@savePaymentSettings')->name('message.seen')->middleware(['auth', 'XSS']);

Route::get('/search', ['as' => 'search.json', 'uses' => 'UserController@search']);


Route::get('/invoices/payments', ['as' => 'invoices.payments', 'uses' => 'InvoiceController@payments',])->middleware(['auth', 'XSS',]);



Route::get('/error', 'UserController@error')->name('error');

/* Clear application cache: */
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache has been cleared';
});

/* Clear route cache: */
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache has been cleared';
});

/* Clear config cache: */
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache has been cleared';
});

/* Clear view cache: */
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return 'View cache has been cleared';
});

/* Clear optimize */
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return 'Configuration & Route cache cleared successfully';
});

/* Clear permission cache */
Route::get('/permission-clear', function () {
    $exitCode = Artisan::call('permission:cache-reset');
    return 'Permission cache cleared successfully';
});

// web.php (Routes)
Route::get('student/register', [StudentController::class, 'create'])->name('student.register');
Route::get('tutor/register', [TutorController::class, 'create'])->name('tutor.register');
Route::get('/register/tutor', [RegisterController::class, 'showRegistrationForm']);
Route::get('/register/student', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);
