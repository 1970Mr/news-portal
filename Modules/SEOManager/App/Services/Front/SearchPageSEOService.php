<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;

class SearchPageSEOService extends BaseSEOService
{
    public function setSearchPageSEO(string $searchText): void
    {
        $cacheKey = 'search_seo_' . md5($searchText);
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () use ($searchText) {
            $description = __('search_description', ['searchText' => $searchText]);
            $canonicalUrl = route('search.index', ['text' => $searchText]);

            return compact('description', 'canonicalUrl');
        });

        $this->setBasicSEO($seoData['description'], $seoData['description'], $seoData['canonicalUrl']);

        OpenGraph::setType('search');
        JsonLd::setType('SearchResultsPage');
    }
}
