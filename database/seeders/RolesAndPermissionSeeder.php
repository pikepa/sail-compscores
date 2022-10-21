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
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'read-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'delete-role']);
        Permission::create(['name' => 'publish-role']);

        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'read-permission']);
        Permission::create(['name' => 'update-permission']);
        Permission::create(['name' => 'delete-permission']);
        Permission::create(['name' => 'publish-permission']);

        Permission::create(['name' => 'create-client']);
        Permission::create(['name' => 'read-client']);
        Permission::create(['name' => 'update-client']);
        Permission::create(['name' => 'delete-client']);
        Permission::create(['name' => 'publish-client']);

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'invite-user']);
        Permission::create(['name' => 'read-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'publish-user']);

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
        ->givePermissionTo([
            'read-role', 'read-permission',
            'read-user', 'invite-user',
            'read-client', 'update-client', 'publish-client',
            'create-comp', 'read-comp', 'update-comp', 'delete-comp', 'publish-comp', ]);

        // or may be done by chaining
        $role = Role::create(['name' => 'CompManager'])
            ->givePermissionTo(['read-client', 'read-comp', 'update-comp', 'publish-comp']);
    }
}
