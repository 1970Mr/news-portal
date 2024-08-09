<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Role\App\Models\Role;
use Modules\Role\Database\Seeders\PermissionSeeder;
use Modules\Role\Database\Seeders\RoleSeeder;
use Modules\User\App\Helpers\UserHelper;
use Modules\User\App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed users: ', function () {
            $admin_role = Role::query()->where('name', Role::ADMIN)->first();
            if (! $admin_role) {
                $this->call([
                    PermissionSeeder::class,
                    RoleSeeder::class,
                ]);
            }

            User::factory(10)->create();

            if (! User::getFirstAdmin()) {
                UserHelper::firstOrCreateAdminUser();
            }
        });
    }
}
