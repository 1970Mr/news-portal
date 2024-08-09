<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Modules\User\App\Models\User;

class AuthorPageSEOService extends BaseSEOService
{
    public function setAuthorPageSEO(User $author): void
    {
        $cacheKey = 'author_seo_'.$author->id;
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () use ($author) {
            $seoSetting = $author->seoSetting;
            $authorName = $seoSetting?->meta_author ?? $author->full_name;
            $title = $seoSetting?->meta_title ?? $authorName;
            $description = $seoSetting?->meta_description ?? 'Profile of '.$author->full_name;
            $authorUrl = route('author.index', $author->username);
            $canonicalUrl = $seoSetting?->canonical_url ?? $authorUrl;
            $keywords = ! empty($seoSetting?->keywords) ? explode(',', $seoSetting->keywords) : [];
            $robots = $seoSetting?->robots ?? 'index, follow';

            return compact('title', 'description', 'canonicalUrl', 'keywords', 'robots', 'authorName', 'authorUrl');
        });

        $this->setBasicSEO(
            $seoData['title'],
            $seoData['description'],
            $seoData['canonicalUrl'],
            $seoData['robots'],
            $seoData['keywords']
        );

        OpenGraph::setType('profile');
        OpenGraph::addProperty('profile:full_name', $seoData['authorName']);
        OpenGraph::addProperty('profile:username', $author->username);

        SEOMeta::addMeta('article:author', $seoData['authorUrl'], 'property');
        SEOMeta::addMeta('article:author_name', $seoData['authorName'], 'property');

        TwitterCard::setTitle($seoData['authorName']);
        TwitterCard::setDescription($seoData['description']);

        JsonLd::setType('Person');
        JsonLd::setTitle($seoData['authorName']);
        JsonLd::setDescription($seoData['description']);
    }
}
