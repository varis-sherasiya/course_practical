<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'users-list',
           'users-create',
           'users-edit',
           'users-delete',
        ];

        foreach ($permissions as $permission) {
             Permission::updateOrCreate(['name' => $permission]);
        }
        $role = Role::where('id',1)->first();
        $role->syncPermissions($permissions);
        Artisan::call('cache:forget spatie.permission.cache');

        Artisan::call('config:cache');
    }
}
