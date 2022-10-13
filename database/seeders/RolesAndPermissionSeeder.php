<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

        Permission::create(['name' => 'create-comp']);
        Permission::create(['name' => 'read-comp']);
        Permission::create(['name' => 'update-comp']);
        Permission::create(['name' => 'delete-comp']);
        Permission::create(['name' => 'publish-comp']);

        Permission::create(['name' => 'create-event']);
        Permission::create(['name' => 'read-event']);
        Permission::create(['name' => 'update-event']);
        Permission::create(['name' => 'delete-event']);
        Permission::create(['name' => 'publish-event']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'SuperAdmin']);
        $role->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role = Role::create(['name' => 'ClientAdmin'])
        ->givePermissionTo(['read-org', 'update-org', 'publish-org',
                            'create-comp','read-comp','update-comp','delete-comp']);

        // or may be done by chaining
        $role = Role::create(['name' => 'CompManager'])
            ->givePermissionTo(['read-org', 'read-comp', 'update-comp', 'publish-comp']);


    }
}
