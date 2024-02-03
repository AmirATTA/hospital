<?php

namespace App\Traits;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

trait HasPermission
{
    public function createPermissions(array $permissions): array
    {
        $permissionNames  = [];
        foreach ($permissions as $name => $label) {
            $permission = new Permission();
            $permission->name = $name;
            $permission->label = $label;
            $permission->save();

            $permissionNames[] = $permission->name;
        }

        return $permissionNames;
    }

    public function assignPermissions(array $permissionNames, string $role): void
    {
        $role = Role::query()->where('name', $role)->first();
        foreach ($permissionNames as $permissionName) {
            $role->givePermissionTo($permissionName);
        }
    }
}