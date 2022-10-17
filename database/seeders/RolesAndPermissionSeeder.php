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

        Permission::create(['name' => 'create-org']);
        Permission::create(['name' => 'read-org']);
        Permission::create(['name' => 'update-org']);
        Permission::create(['name' => 'delete-org']);
        Permission::create(['name' => 'publish-org']);

        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'invite-users']);
        Permission::create(['name' => 'read-users']);
        Permission::create(['name' => 'update-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'publish-users']);

        Permission::create(['name' => 'create-comps']);
        Permission::create(['name' => 'read-comps']);
        Permission::create(['name' => 'update-comps']);
        Permission::create(['name' => 'delete-comps']);
        Permission::create(['name' => 'publish-comps']);

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
                'read-users','invite-users',
                'read-org', 'update-org', 'publish-org',
                'create-comps','read-comps','update-comps','delete-comps','publish-comps']);

        // or may be done by chaining
        $role = Role::create(['name' => 'CompManager'])
            ->givePermissionTo(['read-org', 'read-comps', 'update-comps', 'publish-comps']);


    }
}
