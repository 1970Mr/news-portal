<?php

namespace Modules\Role\App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\PermissionRegistrar;

class Role extends SpatieRole
{
    // Default roles
    public const ADMIN = 'Admin';
    public const EDITOR = 'Editor';
    public const AUTHOR = 'Author';
    public const SUBSCRIBER = 'Subscriber';

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
        // Touch method can be used instead of the following, but an additional request is sent to the database
        $updatedAtName = $this->getUpdatedAtColumn();
        $attributes[$updatedAtName] = $this->updateTimestamps()->{$updatedAtName};
        return parent::update($attributes, $options);
    }

    public function getDefaultRoles(): array
    {
        return [
            self::ADMIN,
            self::EDITOR,
            self::AUTHOR,
            self::SUBSCRIBER,
        ];
    }
}
