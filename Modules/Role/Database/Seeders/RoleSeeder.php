<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Role\App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('roles_list') as $roleData) {
            $roleData = collect($roleData);
            $role = Role::query()->firstOrCreate($roleData->except('permissions')->toArray());
            $role->syncPermissions($roleData['permissions']);
        }
    }
}
