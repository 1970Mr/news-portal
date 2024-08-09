<?php

namespace Modules\Profile\App\Services;

use Modules\FileManager\App\Services\Image\ImageService;
use Modules\Profile\App\Http\Requests\ProfileRequest;
use Modules\User\App\Models\User;

class ProfileService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function update(ProfileRequest $request): bool
    {
        $user = User::query()->find(auth()->id());
        $data = $request->validated();
        $this->imageService->uploadImageDuringUpdate($request, $user, $user->full_name);

        return $user->update($data);
    }
}
