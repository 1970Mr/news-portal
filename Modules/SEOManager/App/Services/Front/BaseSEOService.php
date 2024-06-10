<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Collection;

class BaseSEOService
{
    protected const CACHE_TTL = 1;

    protected function setBasicSEO(
        ?string $title = null,
        ?string $description = null,
        ?string $canonicalUrl = null,
        string $robots = 'index, follow',
        array|Collection $keywords = []
    ): void
    {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical($canonicalUrl);
        if (!empty($keywords)) {
            SEOMeta::addKeyword($keywords);
        }
        SEOMeta::addMeta('robots', $robots);
    }

    protected function setOpenGraphSEO(
        string  $url,
        string  $type,
        ?string $imageUrl = null,
        string  $locale = 'fa-ir'): void
    {
        SEOTools::opengraph()->setUrl($url);
        if ($imageUrl) {
            SEOTools::opengraph()->addImage($imageUrl, ['width' => 300]);
        }
        SEOTools::opengraph()->addProperty('type', $type);
        SEOTools::opengraph()->addProperty('locale', $locale);
    }

    protected function setTwitterSEO(?string $title = null): void
    {
        SEOTools::twitter()->setTitle($title);
    }

    protected function setJsonLdSEO(
        ?string $title = null,
        ?string $description = null,
        ?string $type = null,
        ?string $imageUrl = null): void
    {
        SEOTools::jsonLd()->setType($type);
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($description);
        if ($imageUrl) {
            SEOTools::jsonLd()->addImage($imageUrl);
        }
    }
}
