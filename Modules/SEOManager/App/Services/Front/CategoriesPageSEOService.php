<?php

namespace Modules\SEOManager\App\Services\Front;

use Modules\Category\App\Models\Category;
use Modules\Setting\App\Models\SiteDetail;

class CategoriesPageSEOService extends BaseSEOService
{
    public function setCategoryPageSEO(Category $category): void
    {
        $cacheKey = 'category_seo_'.$category->id;
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () use ($category) {
            $seoSetting = $category->seoSetting;
            $title = $seoSetting?->meta_title ?? $category->name;
            $description = $seoSetting?->meta_description;
            $categoryUrl = route('categories.show', $category->slug);
            $canonicalUrl = $seoSetting?->canonical_url ?? $categoryUrl;
            $keywords = ! empty($seoSetting?->keywords) ? explode(',', $seoSetting->keywords) : [];
            $robots = $seoSetting?->robots ?? 'index, follow';
            $imageUrl = asset('storage/'.$category->image->file_path);

            return compact('title', 'description', 'categoryUrl', 'canonicalUrl', 'keywords', 'robots', 'imageUrl');
        });

        $this->setBasicSEO(
            $seoData['title'],
            $seoData['description'],
            $seoData['canonicalUrl'],
            $seoData['robots'],
            $seoData['keywords']
        );

        $this->setOpenGraphSEO($seoData['categoryUrl'], 'category', $seoData['imageUrl']);
        $this->setJsonLdSEO($seoData['title'], $seoData['description'], 'Category', $seoData['imageUrl']);
        $this->setTwitterSEO($seoData['title'], $seoData['imageUrl']);
    }

    public function setCategoriesPageSEO(): void
    {
        $cacheKey = 'categories_page_seo';
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () {
            $siteDetails = SiteDetail::first();
            $title = __('categories');
            $description = __('Browse all categories available on our website.');
            $canonicalUrl = route('categories.index');
            $logoUrl = $siteDetails->mainLogoLink();

            return compact('title', 'description', 'canonicalUrl', 'logoUrl');
        });

        $this->setBasicSEO($seoData['title'], $seoData['description'], $seoData['canonicalUrl']);
        $this->setOpenGraphSEO($seoData['canonicalUrl'], 'category', $seoData['logoUrl']);
        $this->setJsonLdSEO($seoData['title'], $seoData['description'], 'Category', $seoData['logoUrl']);
        $this->setTwitterSEO($seoData['title'], $seoData['logoUrl']);
    }
}
