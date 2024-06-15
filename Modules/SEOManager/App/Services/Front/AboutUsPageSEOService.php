<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\SEOTools;
use Modules\Setting\App\Models\SiteDetail;

class AboutUsPageSEOService extends BaseSEOService
{
    public function setAboutUsPageSEO(): void
    {
        $cacheKey = 'aboutus_seo';
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function() {
            $siteDetails = SiteDetail::first();
            $title = __('about_us');
            $description = __('about_us_description', ['siteName' => config('app.name')]);
            $canonicalUrl = route('about-us.index');
            $logoUrl = $siteDetails->mainLogoLink();

            return compact('title', 'description', 'canonicalUrl', 'logoUrl');
        });

        $this->setBasicSEO($seoData['title'], $seoData['description'], $seoData['canonicalUrl']);

        if ($seoData['logoUrl']) {
            SEOTools::jsonLd()->addImage($seoData['logoUrl']);
        }
    }
}
