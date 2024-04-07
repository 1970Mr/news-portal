<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\App\Helpers\UserHelper;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
             PermissionSeeder::class,
             RoleSeeder::class,
         ]);

         UserHelper::assignAdminRoleToAdminUser();
    }
}
