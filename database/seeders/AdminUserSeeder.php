<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed admin user
        $user=User::create([
            'name' => 'System Admin',
            'email' => 'admin@admin.admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@admin.admin'),
        ]);
        $role=Role::where('name', 'admin')->get()->first();
        $role->givePermissionTo(Permission::all());
        $user->assignRole($role);
    }
}
