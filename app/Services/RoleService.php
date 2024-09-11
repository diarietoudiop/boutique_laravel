<?php

namespace App\Services;

use App\Services\Interfaces\RoleServiceInterface;
use App\Models\Role;

class RoleService implements RoleServiceInterface
{
    public static function getRoleIdByName(string $roleName): ?int
    {
        $role = Role::where('libelle', $roleName)->first();
        return $role ? $role->id : null;
    }
}
