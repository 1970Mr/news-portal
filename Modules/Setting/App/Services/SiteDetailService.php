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
        $siteDetail = SiteDetail::query()->firstOrNew();
        if ($headerLogo = $this->storeImage($request, 'header_logo', 'Header Logo')) {
            $this->imageService->destroyWithoutKeyConstraints($siteDetail->headerLogo);
            $siteDetail->header_logo_id = $headerLogo->id;
        }
        if ($footerLogo = $this->storeImage($request, 'footer_logo', 'Footer Logo')) {
            $this->imageService->destroyWithoutKeyConstraints($siteDetail->footerLogo);
            $siteDetail->footer_logo_id = $footerLogo->id;
        }
        $siteDetail->fill($request->only('footer_description'))->save();
    }

    private function storeImage(SiteDetailRequest $request, string $fieldName, string $altText): ?Model
    {
        if ($request->hasFile($fieldName)) {
            return $this->imageService->store($request, $fieldName, "$altText | " . config('app.name'));
        }
        return null;
    }
}
