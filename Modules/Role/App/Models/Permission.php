<?php

namespace Modules\Role\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $appends = ['local_name'];

    protected function localName(): Attribute
    {
        return Attribute::make(
            get: fn () => __($this->name),
        );
    }

    public function getPermissionGroupName(): string
    {
        $parts = explode('::', $this->name);
        if (count($parts) >= 2) {
            return strtolower($parts[0]);
        }
        return 'default_group';
    }

    public static function groupedPermissions($permissions): array
    {
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $groupName = $permission->getPermissionGroupName();
            $groupedPermissions[$groupName][] = $permission;
        }
        return $groupedPermissions;
    }
}
