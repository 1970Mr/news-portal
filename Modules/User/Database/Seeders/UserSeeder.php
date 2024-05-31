<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\User\App\Helpers\UserHelper;
use Modules\User\App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed users: ', static function() {
            $users = User::factory(10)->create();

            foreach ($users as $user) {
                $profilePicture = UserHelper::createDefaultProfilePicture($user->id);
                $user->image()->save($profilePicture);
            }
        });
    }
}
