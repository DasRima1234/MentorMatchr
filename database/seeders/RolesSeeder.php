<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Create Roles Only If They Don't Exist
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }

        if (!Role::where('name', 'Tutor')->exists()) {
            Role::create(['name' => 'Tutor']);
        }

        if (!Role::where('name', 'Student')->exists()) {
            Role::create(['name' => 'Student']);
        }

        // Define Permissions
        $permissions = [
            'manage students',
            'manage tutors',
            'manage courses',
            'manage enrollments',
            'manage attendance',
            'manage payments',
            'manage reports',
        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }

        // Assign Permissions to Roles
        $admin = Role::findByName('Admin');
        $admin->givePermissionTo(Permission::all());

        $tutor = Role::findByName('Tutor');
        $tutor->givePermissionTo(['manage students', 'manage attendance']);

        $student = Role::findByName('Student');
        $student->givePermissionTo([]);
    }
}
