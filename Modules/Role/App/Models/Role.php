<?php

namespace Modules\Role\App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\PermissionRegistrar;

class Role extends SpatieRole
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            config('permission.table_names.role_has_permissions'),
            app(PermissionRegistrar::class)->pivotRole,
            app(PermissionRegistrar::class)->pivotPermission
        );
    }

    public function getPermissionLocalNames(): string
    {
        return $this->permissions()->orderBy('name', 'desc')->get()->pluck('local_name')->implode(', ');
    }

    public function update(array $attributes = [], array $options = []): bool
    {
        $this->touch();
        return parent::update($attributes, $options);
    }
}
