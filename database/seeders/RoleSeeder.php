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
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach(config('roles') as $role => $permissions)
        {
            Role::create(['name' => $role]);
            $this->createPermissions($role, $permissions);
        }
    }

    public function createPermissions(&$role, $permissions)
    {
        $this->createPermission('', $permissions, $role);
    }

    public function createPermission($before, $permissions, &$role)
    {
        foreach($permissions as $keyPermission => $valuePermission)
        {
            $newBefore = (strlen($before) > 0 ? $before . '.' : '');
            
            if(is_string($keyPermission))
            {
                $this->createPermission(
                    $newBefore . $keyPermission, 
                    $valuePermission, 
                    $role
                );
            }
            else
            {
                Permission::firstOrCreate(['name' => $newBefore . $valuePermission])
                    ->assignRole($role);
            }
        }
    }
}
