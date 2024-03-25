<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Role\App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $rolesData = file_get_contents(module_path('Role', 'Database/Seeders/JsonData/Roles.json'));
        $rolesData = json_decode($rolesData, true, 512, JSON_THROW_ON_ERROR);

        foreach ($rolesData as $roleData) {
            $role = Role::findOrCreate($roleData['name']);
            $role->syncPermissions($roleData['permissions']);
        }
    }
}