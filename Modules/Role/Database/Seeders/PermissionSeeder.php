<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Role\App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed permissions: ', static function() {
            foreach (config('permissions_list') as $permission) {
                Permission::findOrCreate($permission);
            }
        });
    }
}
