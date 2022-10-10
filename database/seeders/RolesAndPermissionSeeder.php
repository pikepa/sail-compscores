<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create-org']);
        Permission::create(['name' => 'read-org']);
        Permission::create(['name' => 'update-org']);
        Permission::create(['name' => 'delete-org']);
        Permission::create(['name' => 'publish-org']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'SuperAdmin']);
        $role->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role = Role::create(['name' => 'ClientOwner'])
            ->givePermissionTo(['read-org','update-org', 'publish-org']);

    }
}