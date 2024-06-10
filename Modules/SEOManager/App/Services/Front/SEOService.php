<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Collection;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Setting\App\Models\SiteDetail;
use Modules\Tag\App\Models\Tag;
use Modules\User\App\Models\User;

class SEOService
{
    public function setHomePageSEO(): void
    {
        $siteDetails = SiteDetail::with('mainLogo')->latest()->first();
        $siteUrl = route('home.index');
        $title = $siteDetails->title;
        $description = $siteDetails->description;
        $this->setBasicSEO(
            $title,
            $description,
            $siteUrl,
            keywords: explode(',', $siteDetails->keywords)
        );

        OpenGraph::addProperty('type', 'website');

        $logoUrl = null;
        if ($siteDetails && $siteDetails->mainLogo) {
            $logoUrl = asset('storage/' . $siteDetails->mainLogo->file_path);
        }

        OpenGraph::addProperty('site_name', __('news agency') . ' ' . config('app.name'));
        $this->setOpenGraphSEO($siteUrl, 'website', $logoUrl);
        $this->setJsonLdSEO($title, $description, 'Website', $logoUrl);
        $this->setTwitterSEO($title);
    }

    public function setArticlePageSEO(Article $article): void
    {
        $seoSettings = $article->seoSettings;
        $user = $article->user;
        $category = $article->category;

        $title = $seoSettings?->meta_title ?? $article->title;
        $description = $seoSettings?->meta_description ?? $article->bodyText();
        $articleUrl = route('news.show', [$category->slug, $article->slug]);
        $canonicalUrl = $seoSettings?->canonical_url ?? $articleUrl;
        $robots = $seoSettings?->robots ?? 'index, follow';
        $tags = $article->tags->pluck('name');
        $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : $tags;
        $authorName = $seoSettings?->meta_author ?? $user->full_name;
        $authorUrl = route('author.index', $user->username);
        $imageUrl = asset('storage/' . $article->image->file_path);

        $this->setBasicSEO($title, $description, $canonicalUrl, $robots, $keywords);
        $this->setOpenGraphSEO($articleUrl, 'article', $imageUrl);
        $this->setTwitterSEO($title);
        $this->setJsonLdSEO($title, $description, 'Article', $imageUrl);
        $this->setMetaTags($article, $authorUrl, $authorName, $tags, $category);
    }

    public function setAuthorPageSEO(User $author): void
    {
        $seoSettings = $author->seoSettings;
        $authorName = $seoSettings?->meta_author ?? $author->full_name;
        $title = $seoSettings?->meta_title ?? $authorName;
        $description = $seoSettings?->meta_description ?? "Profile of " . $author->full_name;
        $authorUrl = route('author.index', $author->username);
        $canonicalUrl = $seoSettings?->canonical_url ?? $authorUrl;
        $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : [];
        $robots = $seoSettings?->robots ?? 'index, follow';

        $this->setBasicSEO(
            $title,
            $description,
            $canonicalUrl,
            $robots,
            $keywords
        );

        OpenGraph::setType('profile');
        OpenGraph::addProperty('profile:full_name', $authorName);
        OpenGraph::addProperty('profile:username', $author->username);

        SEOMeta::addMeta('article:author', $authorUrl, 'property');
        SEOMeta::addMeta('article:author_name', $authorName, 'property');

        TwitterCard::setTitle($authorName);
        TwitterCard::setDescription($description);

        JsonLd::setType('Person');
        JsonLd::setTitle($authorName);
        JsonLd::setDescription($description);
    }

    public function setAboutUsPageSEO(): void
    {
        $siteDetails = SiteDetail::first();
        $title = __('about_us');
        $description = __('about_us_description', ['siteName' => config('app.name')]);
        $canonicalUrl = route('about-us.index');
        $this->setBasicSEO($title, $description, $canonicalUrl);

        if ($siteDetails && $siteDetails->mainLogo) {
            SEOTools::jsonLd()->addImage(asset('storage/' . $siteDetails->mainLogo->file_path));
        }
    }

    public function setContactUsPageSEO(): void
    {
        $siteDetails = SiteDetail::first();
        $title = __('contact_us');
        $description = __('Get in touch with us for any inquiries or support.');
        $canonicalUrl = route('contact-us.index');
        $this->setBasicSEO($title, $description, $canonicalUrl);

        if ($siteDetails && $siteDetails->mainLogo) {
            SEOTools::jsonLd()->addImage(asset('storage/' . $siteDetails->mainLogo->file_path));
        }
    }

    public function setCategoryPageSEO(Category $category): void
    {
        $seoSettings = $category->seoSettings;
        $title = $seoSettings?->meta_title ?? $category->name;
        $description = $seoSettings?->meta_description;
        $categoryUrl = route('categories.show', $category->slug);
        $canonicalUrl = $seoSettings?->canonical_url ?? $categoryUrl;
        $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : [];
        $robots = $seoSettings?->robots ?? 'index, follow';

        $this->setBasicSEO(
            $title,
            $description,
            $canonicalUrl,
            $robots,
            $keywords
        );

        $imageUrl = asset('storage/' . $category->image->file_path);
        $this->setOpenGraphSEO($categoryUrl, 'category', $imageUrl);
        $this->setJsonLdSEO($title, $description, 'Category', $imageUrl);
        $this->setTwitterSEO($title);
    }

    public function setTagPageSEO(Tag $tag): void
    {
        $seoSettings = $tag->seoSettings;
        $title = $seoSettings?->meta_title ?? $tag->name;
        $description = $seoSettings?->meta_description;
        $tagUrl = route('tags.show', $tag->slug);
        $canonicalUrl = $seoSettings?->canonical_url ?? $tagUrl;
        $keywords = !empty($seoSettings?->keywords) ? explode(',', $seoSettings->keywords) : [];
        $robots = $seoSettings?->robots ?? 'index, follow';

        $this->setBasicSEO(
            $title,
            $description,
            $canonicalUrl,
            $robots,
            $keywords
        );

        $this->setOpenGraphSEO($tagUrl, 'tag');
        $this->setJsonLdSEO($title, $description, 'Tag');
        $this->setTwitterSEO($title);
    }

    public function setSearchPageSEO(string $searchText): void
    {
        $description = __('search_description', ['searchText' => $searchText]);
        $canonicalUrl = route('search.index', ['text' => $searchText]);
        $this->setBasicSEO($description, $description, $canonicalUrl);

        OpenGraph::setType('search');
        JsonLd::setType('SearchResultsPage');
    }

    private function setBasicSEO(
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

    private function setOpenGraphSEO(
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

    private function setTwitterSEO(?string $title = null): void
    {
        SEOTools::twitter()->setTitle($title);
    }

    private function setJsonLdSEO(
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
