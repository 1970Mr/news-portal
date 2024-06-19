<?php

namespace Modules\SEOManager\App\Services\Front;

use Modules\Tag\App\Models\Tag;

class TagPageSEOService extends BaseSEOService
{
    public function setTagPageSEO(Tag $tag): void
    {
        $cacheKey = 'tag_seo_' . $tag->id;
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () use ($tag) {
            $seoSettings = $tag->seoSettings;
            $title = $seoSettings?->meta_title ?? $tag->name;
            $description = $seoSettings?->meta_description;
            $tagUrl = route('tags.show', $tag->slug);
            $canonicalUrl = $seoSettings?->canonical_url ?? $tagUrl;
            $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : [];
            $robots = $seoSettings?->robots ?? 'index, follow';

            return compact('title', 'description', 'tagUrl', 'canonicalUrl', 'keywords', 'robots');
        });

        $this->setBasicSEO(
            $seoData['title'],
            $seoData['description'],
            $seoData['canonicalUrl'],
            $seoData['robots'],
            $seoData['keywords']
        );

        $this->setOpenGraphSEO($seoData['tagUrl'], 'tag');
        $this->setJsonLdSEO($seoData['title'], $seoData['description'], 'Tag');
        $this->setTwitterSEO($seoData['title']);
    }
}
