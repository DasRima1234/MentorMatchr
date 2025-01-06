<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Utility;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // php artisan permission:create-permission "Pivot Management" web
    // php artisan permission:create-permission "Tools Management" web
    // php artisan permission:create-permission "Tools Show" web

   public function run()
    {

        $arrPermissions = [



            'Dashboard',

            /** Users Permissions define  */
                'Manage Users',
                'Create User',
                'Edit User',
                'Delete User',
            /** Users Permissions end  */

                /** Roles Permissions define  */
                'Manage Roles',
                'Create Role',
                'Edit Role',
                'Delete Role',
            /** Roles Permissions end  */
            'Management',

        ];

        foreach($arrPermissions as $ap)
        {
            Permission::create(['name' => $ap]);
        }

        $adminRole = Role::create(
            [
                'name' => 'Owner',
                'created_by' => 0,
            ]
        );

        $adminPermissions = [


            'Dashboard',

         
            /** Users Permissions define  */
                'Manage Users',
                'Create User',
                'Edit User',
                'Delete User',
            /** Users Permissions end  */

                /** Roles Permissions define  */
                'Manage Roles',
                'Create Role',
                'Edit Role',
                'Delete Role',
            /** Roles Permissions end  */
            'Management',


        ];

        foreach($adminPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $adminRole->givePermissionTo($permission);
        }
        $admin = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'user_name' => 'USER1234',
                'password' => Hash::make('1234'),
                'type' => 'Owner',
                'lang' => 'en',
                'created_by' => 0,
            ]
        );
        $admin->assignRole($adminRole);
        $admin->defaultEmail();
       // $admin->userDefaultData();

        // print_r($admin);die('+++++');

        $clientRole        = Role::create(
            [
                'name' => 'Client',
                'created_by' => 0,
            ]
        );
        $clientPermissions = [
            "Dashboard",

        ];
        foreach($clientPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $clientRole->givePermissionTo($permission);
        }

        $userRole        = Role::create(
            [
                'name' => 'linkITStaff',
                'created_by' => $admin->id,
            ]
        );
        $userPermissions = [
            

        ];

        foreach($userPermissions as $ap)
        {
            $permission = Permission::findByName($ap);
            $userRole->givePermissionTo($permission);
        }
        $user = User::create(
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'user_name' => 'USER1234',
                'password' => Hash::make('1234'),
                'type' => 'linkITStaff',
                'lang' => 'en',
                'created_by' => $admin->id,
            ]
        );
        $user->assignRole($userRole);

    }
}
