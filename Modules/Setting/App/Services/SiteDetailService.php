<?php

namespace Modules\Setting\App\Services;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Modules\FileManager\App\Services\ImageService;
use Modules\Setting\App\Http\Requests\SiteDetailRequest;
use Modules\Setting\App\Models\SiteDetail;

class SiteDetailService
{
    public function __construct(private readonly ImageService $imageService)
    {
    }

    public function update(SiteDetailRequest $request): void
    {
        $siteDetails = SiteDetail::query()->firstOrNew();

        $this->updateImage($request, $siteDetails, 'main_logo');
        $this->updateImage($request, $siteDetails, 'second_logo');
        $this->updateImage($request, $siteDetails, 'favicon');

        $siteDetails->fill($request->except(['main_logo', 'second_logo', 'favicon']))->save();
    }

    private function updateImage(SiteDetailRequest $request, SiteDetail $siteDetails, string $fieldName): void
    {
        if ($image = $this->storeImage($request, $fieldName)) {
            $relation = $this->getRelationName($fieldName);
            if ($siteDetails->{$relation}) {
                $this->imageService->destroyWithoutKeyConstraints($siteDetails->{$relation});
            }
            $siteDetails->{$fieldName . '_id'} = $image->id;
        }
    }

    private function storeImage(SiteDetailRequest $request, string $fieldName): ?Model
    {
        if ($request->hasFile($fieldName)) {
            $altText = $this->getAltText($fieldName) . config('seotools.meta.defaults.separator') . config('app.name');
            return $this->imageService->store($request, $fieldName, $altText);
        }
        return null;
    }

    private function getAltText(string $fieldName): string
    {
        return match ($fieldName) {
            'main_logo' => 'Main Logo',
            'second_logo' => 'Second Logo',
            'favicon' => 'Favicon',
            default => 'Image',
        };
    }

    private function getRelationName(string $fieldName): string
    {
        return match ($fieldName) {
            'main_logo' => 'mainLogo',
            'second_logo' => 'secondLogo',
            'favicon' => 'favicon',
            default => throw new InvalidArgumentException("Invalid field name: $fieldName"),
        };
    }
}
