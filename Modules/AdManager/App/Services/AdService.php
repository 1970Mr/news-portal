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
        $data = $request->validated();
        $ad = Ad::query()->create($data);
        $image = $this->imageService->store($request, altText: $ad->title);
        $ad->image()->save($image);
        return $ad;
    }

    public function update(AdRequest $request, Ad $ad): void
    {
        $data = $request->validated();
        Ad::query()->create($data);
        $this->imageService->uploadImageDuringUpdate($request, $ad, $ad->title);
    }

    public function destroy(Ad $ad): void
    {
        $this->imageService->destroyWithoutKeyConstraints($ad->image);
        $ad->delete();
    }
}
