<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Role\App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed roles: ', static function() {
            foreach (config('roles_list') as $roleData) {
                $roleData = collect($roleData);
                $role = Role::query()->firstOrCreate($roleData->except('permissions')->toArray());
                $role->syncPermissions($roleData['permissions']);
            }
        });
    }
}
