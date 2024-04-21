<?php

namespace Modules\User\App\Services;

use Illuminate\Support\Facades\Gate;
use Modules\FileManager\App\Services\ImageService;
use Modules\User\App\Http\Requests\UserStoreRequest;
use Modules\User\App\Http\Requests\UserUpdateRequest;
use Modules\User\App\Models\User;

class UserService
{
    public function __construct(
        private readonly ImageService $imageService
    ) {}

    public function store(UserStoreRequest $request): void
    {
        $data = $request->validated();
        $request->merge(['alt_text' => 'User profile picture']);
        $data['picture_id'] = $this->imageService->store($request, 'picture')->id;
        $user = User::create($data);
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
