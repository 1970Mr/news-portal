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
        $data = $request->validated();
        $data = $this->uploadImageDuringUpdate($request, $user, $data);
        $user->update($data);
        $this->checkEmailAsVerified($request, $user);
    }

    public function delete(User $user): void
    {
        Gate::authorize('delete', $user);
        $user->delete();
    }

    private function uploadImageDuringUpdate(UserUpdateRequest $request, User $user, array $data): array
    {
        if ($request->hasFile('picture')) {
            $request->merge(['alt_text' => 'User profile picture']);
            $data['picture_id'] = $this->imageService->store($request, 'picture')->id;
            $this->imageService->destroyWithoutKeyConstraints($user->picture);
        }
        return $data;
    }

    private function checkEmailAsVerified(UserUpdateRequest $request, User $user): void
    {
        ($request->email_verification) ?
            $user->markEmailAsVerified() :
            $user->unmarkEmailAsVerified();
    }
}
