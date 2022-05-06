<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create buildings',
            'update buildings',
            'delete buildings',
            'show buildings',

            'create apartments',
            'update apartments',
            'delete apartments',
            'show apartments',

            'create tenants',
            'update tenants',
            'delete tenants',
            'show tenants',
        ];

        foreach($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $lessor = Role::create(['name' => 'lessor']);
        $lessor->givePermissionTo($permissions);

        $tenant = Role::create(['name' => 'tenant']);
        $tenant->givePermissionTo([
            'show buildings',
            'show apartments',
        ]);
    }
}
