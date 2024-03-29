<?php

namespace Modules\Role\App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $appends = ['local_name'];

    public const SUPER_ADMIN = 'admin::full_access';

    protected function localName(): Attribute
    {
        return Attribute::make(
            get: fn () => __($this->name),
        );
    }
}
