<?php

namespace Modules\Setting\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\FileManager\App\Services\ImageService;
use Modules\Setting\App\Http\Requests\SiteDetailRequest;
use Modules\Setting\App\Models\SiteDetail;

class SiteDetailService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function update(SiteDetailRequest $request): void
    {
        $siteDetails = SiteDetail::query()->firstOrNew();
        if ($headerLogo = $this->storeImage($request, 'header_logo', 'Header Logo')) {
            $this->imageService->destroyWithoutKeyConstraints($siteDetails->headerLogo);
            $siteDetails->header_logo_id = $headerLogo->id;
        }
        if ($footerLogo = $this->storeImage($request, 'footer_logo', 'Footer Logo')) {
            $this->imageService->destroyWithoutKeyConstraints($siteDetails->footerLogo);
            $siteDetails->footer_logo_id = $footerLogo->id;
        }
        $siteDetails->fill($request->only('footer_description'))->save();
    }

    private function storeImage(SiteDetailRequest $request, string $fieldName, string $altText): ?Model
    {
        if ($request->hasFile($fieldName)) {
            return $this->imageService->store($request, $fieldName, "$altText | " . config('app.name'));
        }
        return null;
    }
}
