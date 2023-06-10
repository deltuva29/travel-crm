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

        $permissions = [];

        $permissions[] = Permission::create(['name' => 'Peržiūrėti tik savo įrašus', 'guard_name' => 'web']);
        $permissions[] = Permission::create(['name' => 'Redaguoti tik savo įrašus', 'guard_name' => 'web']);

        $entities = [
            'vartotojus',
            'vartotojų roles',
        ];
        foreach ($entities as $entity) {
            $permissions[] = Permission::create(['name' => 'Peržiūrėti ' . $entity, 'guard_name' => 'web']);
            $permissions[] = Permission::create(['name' => 'Kurti ' . $entity, 'guard_name' => 'web']);
            $permissions[] = Permission::create(['name' => 'Redaguoti ' . $entity, 'guard_name' => 'web']);
            $permissions[] = Permission::create(['name' => 'Ištrinti ' . $entity, 'guard_name' => 'web']);
        }

        $permissions[] = Permission::create(['name' => 'Redaguoti nustatymus', 'guard_name' => 'web']);

        $superAdminRole = Role::create(['name' => 'Super administratorius', 'guard_name' => 'web']);
        $directorRole = Role::create(['name' => 'Vadovas', 'guard_name' => 'web']);
        Role::create(['name' => 'Darbuotojas', 'guard_name' => 'web']);

        foreach ($permissions as $permission) {
            if (!str_contains($permission->name, 'tik savo')) {
                $superAdminRole->givePermissionTo($permission->name);
                $directorRole->givePermissionTo($permission->name);
            }
        }
    }
}
