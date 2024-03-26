<?php

namespace Modules\Role\App\Services;

class PermissionService
{
    public function getPermissionGroupName(string $name): string
    {
        $parts = explode('::', $name);
        if (count($parts) >= 2) {
            return strtolower($parts[0]);
        }
        return 'default_group';
    }

    public function groupedPermissions($permissions): array
    {
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $groupName = $this->getPermissionGroupName($permission->name);
            $groupedPermissions[$groupName][] = $permission;
        }
        return $groupedPermissions;
    }
}
