<?php

namespace Modules\Profile\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\FileManager\App\Services\ImageService;
use Modules\Profile\App\Http\Requests\ProfileRequest;
use Modules\User\App\Models\User;

class ProfileService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function update(ProfileRequest $request): bool
    {
        $user = User::query()->find(auth()->id());
        $data = $request->validated();
        $this->uploadImageDuringUpdate($request, $user, $data);
        return $user->update($data);
    }

    private function uploadImageDuringUpdate(ProfileRequest $request, Model $user, array $data): void
    {
        if ($request->hasFile('picture')) {
            $this->imageService->destroyWithoutKeyConstraints($user->image);
            $request->merge(['alt_text' => 'User profile picture']);
            $profile_picture = $this->imageService->store($request, 'picture');
            $user->image()->save($profile_picture);
        }
    }
}
