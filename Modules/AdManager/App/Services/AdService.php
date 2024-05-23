<?php

namespace Modules\AdManager\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\AdManager\App\Http\Requests\AdRequest;
use Modules\AdManager\App\Models\Ad;
use Modules\FileManager\App\Services\ImageService;

class AdService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function store(AdRequest $request): Model
    {
        $ad = Ad::query()->create($request->validated());
        $image = $this->imageService->store($request, altText: $ad->title);
        $ad->image()->save($image);
        return $ad;
    }

    public function update(AdRequest $request, Ad $ad): void
    {
        $ad->update($request->validated());
        $this->imageService->uploadImageDuringUpdate($request, $ad, $ad->title);
    }

    public function destroy(Ad $ad): void
    {
        $this->imageService->destroyWithoutKeyConstraints($ad->image);
        $ad->delete();
    }
}
