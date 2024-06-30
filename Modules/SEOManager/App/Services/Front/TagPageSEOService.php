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
            $seoSetting = $tag->seoSetting;
            $title = $seoSetting?->meta_title ?? $tag->name;
            $description = $seoSetting?->meta_description;
            $tagUrl = route('tags.show', $tag->slug);
            $canonicalUrl = $seoSetting?->canonical_url ?? $tagUrl;
            $keywords = !empty($seoSetting?->keywords) ? explode(',', $seoSetting->keywords) : [];
            $robots = $seoSetting?->robots ?? 'index, follow';

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
