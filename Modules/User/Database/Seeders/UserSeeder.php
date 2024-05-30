<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\App\Helpers\UserHelper;
use Modules\User\App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $profilePicture = UserHelper::createDefaultProfilePicture($user->id);
            $user->image()->save($profilePicture);
        }
    }
}
