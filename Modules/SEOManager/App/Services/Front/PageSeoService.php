<?php
namespace Modules\SEOManager\App\Services\Front;

use Modules\PageBuilder\App\Models\Page;

class PageSEOService extends BaseSEOService
{
    public function setPageSEO(Page $page): void
    {
        $cacheKey = 'page_seo_' . $page->id;
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () use ($page) {
            $seoSettings = $page->seoSettings;

            $title = $seoSettings?->meta_title ?? $page->title;
            $description = $seoSettings?->meta_description ?? $page->summary();
            $pageUrl = $page->url();
            $canonicalUrl = $seoSettings?->canonical_url ?? $pageUrl;
            $robots = $seoSettings?->robots ?? 'index, follow';
            $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : [];

            return compact('title', 'description', 'pageUrl', 'canonicalUrl', 'robots', 'keywords');
        });

        $this->setBasicSEO($seoData['title'], $seoData['description'], $seoData['canonicalUrl'], $seoData['robots'], $seoData['keywords']);
        $this->setOpenGraphSEO($seoData['pageUrl'], 'website', '');
        $this->setTwitterSEO($seoData['title'], '');
        $this->setJsonLdSEO($seoData['title'], $seoData['description'], 'WebPage', '');
    }
}
