<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\OpenGraph;
use Modules\Setting\App\Models\SiteDetail;

class HomePageSEOService extends BaseSEOService
{
    public function setHomePageSEO(): void
    {
        $cacheKey = 'homepage_seo';
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () {
            $siteDetails = SiteDetail::with('mainLogo')->latest()->first();
            $siteUrl = route('home.index');
            $title = $siteDetails->title;
            $description = $siteDetails->description;
            $keywords = explode(',', $siteDetails->keywords);
            $logoUrl = $siteDetails->mainLogoLink();

            return compact('title', 'description', 'siteUrl', 'keywords', 'logoUrl');
        });

        $this->setBasicSEO(
            $seoData['title'],
            $seoData['description'],
            $seoData['siteUrl'],
            keywords: $seoData['keywords']
        );

        OpenGraph::addProperty('type', 'website');
        OpenGraph::addProperty('site_name', __('news agency').' '.config('app.name'));
        $this->setOpenGraphSEO($seoData['siteUrl'], 'website', $seoData['logoUrl']);
        $this->setJsonLdSEO($seoData['title'], $seoData['description'], 'Website', $seoData['logoUrl']);
        $this->setTwitterSEO($seoData['title'], $seoData['logoUrl']);
    }
}
