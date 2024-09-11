<?php

namespace App\Services\Interfaces;

interface RoleServiceInterface
{
    public static function getRoleIdByName(string $roleName): ?int;
}
