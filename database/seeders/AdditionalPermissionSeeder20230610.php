<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdditionalPermissionSeeder20230610 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [];
        $permissions[] = Permission::create(['name' => 'Patvirtinti sąskaitas', 'guard_name' => 'web']);
        $permissions[] = Permission::create(['name' => 'Išsiųsti sąskaitas', 'guard_name' => 'web']);
        $permissions[] = Permission::create(['name' => 'Sąskaitose pridėti papildomas paslaugas', 'guard_name' => 'web']);

        $superAdminRole = Role::where('name', 'Super administratorius')->first();
        foreach ($permissions as $permission) {
            $superAdminRole->givePermissionTo($permission->name);
        }
    }
}
