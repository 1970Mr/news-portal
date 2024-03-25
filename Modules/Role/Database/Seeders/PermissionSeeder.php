<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Role\App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissionsData = file_get_contents(module_path('Role', 'Database/Seeders/JsonData/Permissions.json'));
        $permissionsData = json_decode($permissionsData, true, 512, JSON_THROW_ON_ERROR);

        foreach ($permissionsData as $permission) {
            Permission::findOrCreate($permission);
        }
    }
}
