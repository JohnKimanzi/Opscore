<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan cache:forget spatie.permission.cache
        // php artisan cache:clear

        Role::upsert([
            ['name'=>'Software Developer', 'guard_name'=>'web'],
            ['name'=>'Admin', 'guard_name'=>'web'],
            ['name'=>'Agent', 'guard_name'=>'web'],
            ['name'=>'Head of Operations', 'guard_name'=>'web'],
            ['name'=>'Operations Manager', 'guard_name'=>'web'],
            ['name'=>'Assistant Operations Manager', 'guard_name'=>'web'],
            ['name'=>'Team Coordinator', 'guard_name'=>'web'],
            ['name'=>'Group Coordinator', 'guard_name'=>'web'],
            ['name'=>'Quality Lead', 'guard_name'=>'web'],
            ['name'=>'Quality Coordinator', 'guard_name'=>'web'],
            ['name'=>'Workforce Manager', 'guard_name'=>'web'],
            ['name'=>'Management Information Systems Executive', 'guard_name'=>'web'],
            ['name'=>'BPO Executive', 'guard_name'=>'web'],
            ['name'=>'IT Executive', 'guard_name'=>'web'],
            ['name'=>'Senior Information Technology Executive', 'guard_name'=>'web'],
            ['name'=>'IT Manager', 'guard_name'=>'web'],
            ['name'=>'Business Development Manager', 'guard_name'=>'web'],
            ['name'=>'Business Development Executive', 'guard_name'=>'web'],
            ['name'=>'Presales Executive', 'guard_name'=>'web'],
            ['name'=>'Administration Executive', 'guard_name'=>'web'],
            ['name'=>'Human Resouce Manager', 'guard_name'=>'web'],
            ['name'=>'Human Resouce Executive', 'guard_name'=>'web'],
            ['name'=>'Trainer', 'guard_name'=>'web'],
            ['name'=>'Office Assistant', 'guard_name'=>'web'],
            ['name'=>'Front Desk Executive', 'guard_name'=>'web'],
            ['name'=>'Administration Assistant', 'guard_name'=>'web'],

        ],['name'],['guard_name'],['guard_name']);
    }
}
