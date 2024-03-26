<?php

namespace Modules\Role\App\Services;

use Illuminate\Database\Eloquent\Collection;

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

    public function selectedPermissions(Collection $permissions, string $name, array|null $oldValue): string
    {
        if (($oldValue && in_array($name, $oldValue, true)) ||
            (!$oldValue && $permissions->pluck('name')->contains($name))) {
            return 'checked';
        }
        return '';
    }
}
