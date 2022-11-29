<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::upsert([
            ['name'=>'Manage Users', 'guard_name'=>'web'],
            ['name'=>'Manage Leaves', 'guard_name'=>'web'],
            ['name'=>'Manage Attendance', 'guard_name'=>'web'],
            ['name'=>'Manage Roles', 'guard_name'=>'web'],
            ['name'=>'Manage Permissions', 'guard_name'=>'web'],
            ['name'=>'Manage Employees', 'guard_name'=>'web'],
            ['name'=>'Manage Projects', 'guard_name'=>'web'],
            
        ],['name', 'guard_name'],['guard_name']);
    }
}
