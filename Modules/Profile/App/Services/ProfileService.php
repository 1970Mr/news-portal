<?php

namespace Modules\Profile\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\FileManager\App\Services\ImageService;
use Modules\Profile\App\Http\Requests\ProfileRequest;
use Modules\User\App\Models\User;

class ProfileService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function update(ProfileRequest $request)
    {
        $user = User::query()->find(auth()->id());
        $data = $request->validated();
        $data = $this->uploadImageDuringUpdate($request, $user, $data);
        $user->update($data);
    }

    private function uploadImageDuringUpdate(ProfileRequest $request, Model $user, array $data): array
    {
        if ($request->hasFile('picture')) {
            $request->merge(['alt_text' => 'User profile picture']);
            $data['picture_id'] = $this->imageService->store($request, 'picture')->id;
            $this->imageService->destroyWithoutKeyConstraints($user->picture);
        }
        return $data;
    }
}
