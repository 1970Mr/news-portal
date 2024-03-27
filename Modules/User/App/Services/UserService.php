<?php

namespace Modules\User\App\Services;

use Illuminate\Support\Facades\Gate;
use Modules\Role\App\Models\Role;
use Modules\User\App\Http\Requests\UserStoreRequest;
use Modules\User\App\Http\Requests\UserUpdateRequest;
use Modules\User\App\Models\User;

class UserService
{
    public function create(UserStoreRequest $request): void
    {
        $user = User::create($request->validated());
        if ($request->email_verification) {
            $user->markEmailAsVerified();
        }
    }

    public function update(UserUpdateRequest $request, User $user): void
    {
        $user->update($request->validated());
        ($request->email_verification) ?
            $user->markEmailAsVerified() :
            $user->unmarkEmailAsVerified();
    }

    public function delete(User $user): void
    {
        Gate::authorize('delete', $user);
        $user->delete();
    }
}
