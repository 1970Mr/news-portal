<?php

namespace Modules\Auth\App\Services;

use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\App\Http\Requests\RegisterRequest;
use Modules\User\App\Helpers\UserHelper;
use Modules\User\App\Models\User;

class RegisterService
{
    public function createUser(RegisterRequest $request): Model
    {
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $profile_picture = UserHelper::createDefaultProfilePicture($user->id);
        $user->picture_id = $profile_picture->id;
        $user->save();
        return $user;
    }

    public function register(RegisterRequest $request): bool
    {
        $this->createUser($request);
        if (auth()->attempt($request->all(['email', 'password']), true)) {
            event(new Registered(auth()->user()));
            return true;
        }
        return false;
    }
}
