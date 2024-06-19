<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\SEOMeta;
use Modules\Article\App\Models\Article;

class ArticlePageSEOService extends BaseSEOService
{
    public function setArticlePageSEO(Article $article): void
    {
        $cacheKey = 'article_seo_' . $article->id;
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () use ($article) {
            $seoSettings = $article->seoSettings;
            $user = $article->user;
            $category = $article->category;

            $title = $seoSettings?->meta_title ?? $article->title;
            $description = $seoSettings?->meta_description ?? $article->bodyText();
            $articleUrl = $article->getUrl();
            $canonicalUrl = $seoSettings?->canonical_url ?? $articleUrl;
            $robots = $seoSettings?->robots ?? 'index, follow';
            $tags = $article->tags->pluck('name');
            $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : $tags;
            $authorName = $seoSettings?->meta_author ?? $user->full_name;
            $authorUrl = route('author.index', $user->username);
            $imageUrl = asset('storage/' . $article->image->file_path);

            return compact('title', 'description', 'articleUrl', 'canonicalUrl', 'robots', 'keywords', 'authorName', 'authorUrl', 'imageUrl', 'tags', 'category');
        });

        $this->setBasicSEO($seoData['title'], $seoData['description'], $seoData['canonicalUrl'], $seoData['robots'], $seoData['keywords']);
        $this->setOpenGraphSEO($seoData['articleUrl'], 'article', $seoData['imageUrl']);
        $this->setTwitterSEO($seoData['title'], $seoData['imageUrl']);
        $this->setJsonLdSEO($seoData['title'], $seoData['description'], 'Article', $seoData['imageUrl']);
        $this->setMetaTags($article, $seoData['authorUrl'], $seoData['authorName'], $seoData['tags'], $seoData['category']);
    }

    private function setMetaTags(Article $article, string $authorUrl, string $authorName, $tags, $category): void
    {
        SEOMeta::addMeta('article:published_time', $article->published_at, 'property');
        SEOMeta::addMeta('article:modified_time', $article->updated_at, 'property');
        SEOMeta::addMeta('article:author', $authorUrl, 'property');
        SEOMeta::addMeta('article:author_name', $authorName, 'property');
        SEOMeta::addMeta('article:category', $category->name, 'property');
        SEOMeta::addMeta('article:tag', $tags->implode(','), 'property');
        SEOMeta::addMeta('article:section', $category->name, 'property');
    }
}
