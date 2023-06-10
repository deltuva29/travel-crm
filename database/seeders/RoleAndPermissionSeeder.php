<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Nerodyti vartotojus', 'guard_name' => 'web']);
        Permission::create(['name' => 'Nerodyti nustatymus', 'guard_name' => 'web']);
        Permission::create(['name' => 'Nerodyti Rolių/Leidimų', 'guard_name' => 'web']);

        // create roles

        Role::create(['name' => 'Super administratorius', 'guard_name' => 'web'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'Darbuotojas', 'guard_name' => 'web'])
            ->givePermissionTo(Permission::all());
    }
}
