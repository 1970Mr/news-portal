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
        $user = User::create($data);
        $profile_picture = $this->imageService->store($request, 'picture', $user->name);
        $user->image()->save($profile_picture);
        if ($request->email_verification) {
            $user->markEmailAsVerified();
        }
    }

    public function update(UserUpdateRequest $request, User $user): void
    {
        $data = $request->validated();
        $this->imageService->uploadImageDuringUpdate($request, $user, $user->name);
        $user->update($data);
        $this->checkEmailAsVerified($request, $user);
    }

    public function delete(User $user): void
    {
        Gate::authorize('delete', $user);
        $user->delete();
    }

    private function checkEmailAsVerified(UserUpdateRequest $request, User $user): void
    {
        ($request->email_verification) ?
            $user->markEmailAsVerified() :
            $user->unmarkEmailAsVerified();
    }
}
