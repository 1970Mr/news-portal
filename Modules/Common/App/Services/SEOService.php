<?php

namespace Modules\Common\App\Services;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\TwitterCard;
use Modules\Setting\App\Models\SiteDetail;

class SEOService
{
    public function setHomePageSEO(): void
    {
        $siteDetails = SiteDetail::with('mainLogo')->first();

        SEOTools::setTitle($siteDetails->title, false);
        SEOTools::setDescription($siteDetails->description);
        SEOTools::setCanonical(route('home.index'));
        SEOTools::opengraph()->setUrl(route('home.index'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addProperty('site_name', __('news agency') . ' ' . config('app.name'));
        SEOMeta::addKeyword(explode(',', $siteDetails->keywords));
        SEOMeta::addMeta('robots', 'index, follow');

        if ($siteDetails && $siteDetails->mainLogo) {
            SEOTools::jsonLd()->addImage(asset('storage/' . $siteDetails->mainLogo->file_path));
        }
    }

    public function setArticlePageSEO($article): void
    {
        SEOTools::setTitle($article->title);
        SEOTools::setDescription($article->description);
        SEOTools::setCanonical(route('news.show', [$article->category->slug, $article->slug]));

        SEOMeta::addMeta('article:published_time', $article->published_at, 'property');
        SEOMeta::addMeta('article:modified_time', $article->updated_at, 'property');
        SEOMeta::addMeta('article:author', route('author.index', $article->user->username), 'property');
        SEOMeta::addMeta('article:tag', $article->tags->pluck('name'), 'property');
        SEOMeta::addMeta('article:section', $article->category->name, 'property');
        SEOMeta::addKeyword(explode(',', $article->keywords));
        SEOMeta::addMeta('robots', 'index, follow');

        SEOTools::opengraph()->setUrl(route('news.show', [$article->category->slug, $article->slug]));
        SEOTools::opengraph()->addImage(asset('storage/' . $article->image->file_path), ['width' => 300]);
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->addProperty('locale', 'fa-ir');

        SEOTools::twitter()->setTitle($article->title);
//        SEOTools::twitter()->setSite('@YourTwitterHandle');

        SEOTools::jsonLd()->setType('Article');
        SEOTools::jsonLd()->setTitle($article->title);
        SEOTools::jsonLd()->setDescription($article->description);
        SEOTools::jsonLd()->addImage(asset('storage/' . $article->image->file_path));
    }

    public function setAuthorPageSEO($author): void
    {
        SEOMeta::setTitle($author->full_name);
        SEOMeta::setDescription("Profile of " . $author->full_name);
        SEOMeta::addMeta('author:published_articles', $author->articles()->count(), 'property');
        SEOMeta::addMeta('robots', 'index, follow');

        OpenGraph::setTitle($author->name);
        OpenGraph::setDescription("Profile of " . $author->full_name);
        OpenGraph::setType('profile');
        OpenGraph::addProperty('profile:full_name', $author->full_name);
        OpenGraph::addProperty('profile:username', $author->username);

        TwitterCard::setTitle($author->full_name);
        TwitterCard::setDescription("Profile of " . $author->full_name);
//        TwitterCard::setSite('@' . $author->username);

        JsonLd::setTitle($author->full_name);
        JsonLd::setDescription("Profile of " . $author->full_name);
        JsonLd::setType('Person');
    }

    public function setAboutUsPageSEO(): void
    {
        $siteDetails = SiteDetail::first();

        SEOTools::setTitle(__('about_us'));
        SEOTools::setDescription(__('about_us_description', ['siteName' => config('app.name')]));
        SEOTools::setCanonical(route('about-us.index'));
        SEOTools::opengraph()->setUrl(route('about-us.index'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addMeta('robots', 'index, follow');

        if ($siteDetails && $siteDetails->mainLogo) {
            SEOTools::jsonLd()->addImage(asset('storage/' . $siteDetails->mainLogo->file_path));
        }
    }

    public function setContactUsPageSEO(): void
    {
        $siteDetails = SiteDetail::first();

        SEOTools::setTitle(__('contact_us'));
        SEOTools::setDescription(__('Get in touch with us for any inquiries or support.'));
        SEOTools::setCanonical(route('contact-us.index'));
        SEOTools::opengraph()->setUrl(route('contact-us.index'));
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOMeta::addMeta('robots', 'index, follow');

        if ($siteDetails && $siteDetails->mainLogo) {
            SEOTools::jsonLd()->addImage(asset('storage/' . $siteDetails->mainLogo->file_path));
        }
    }

    public function setCategoryPageSEO($category): void
    {
        SEOTools::setTitle($category->name);
        SEOTools::setDescription(__('category_description', ['categoryName' => $category->name]));
        SEOTools::setCanonical(route('categories.show', $category->slug));
        SEOMeta::addMeta('robots', 'index, follow');

        OpenGraph::setTitle($category->name);
        OpenGraph::setDescription(__('category_description', ['categoryName' => $category->name]));
        OpenGraph::setType('category');

        JsonLd::setTitle($category->name);
        JsonLd::setDescription(__('category_description', ['categoryName' => $category->name]));
        JsonLd::setType('Category');
    }

    public function setTagPageSEO($tag): void
    {
        SEOTools::setTitle($tag->name);
        SEOTools::setDescription(__('tag_description', ['tagName' => $tag->name]));
        SEOTools::setCanonical(route('tags.show', $tag->slug));
        SEOMeta::addMeta('robots', 'index, follow');

        OpenGraph::setTitle($tag->name);
        OpenGraph::setDescription(__('tag_description', ['tagName' => $tag->name]));
        OpenGraph::setType('tag');

        JsonLd::setTitle($tag->name);
        JsonLd::setDescription(__('tag_description', ['tagName' => $tag->name]));
        JsonLd::setType('Tag');
    }

    public function setSearchPageSEO($searchText): void
    {
        SEOTools::setTitle(__('search_description', ['searchText' => $searchText]));
        SEOTools::setDescription(__('search_description', ['searchText' => $searchText]));
        SEOTools::setCanonical(route('search.index', ['text' => $searchText]));
        SEOMeta::addMeta('robots', 'index, follow');

        OpenGraph::setTitle(__('search_description', ['searchText' => $searchText]));
        OpenGraph::setDescription(__('search_description', ['searchText' => $searchText]));
        OpenGraph::setType('search');

        JsonLd::setTitle(__('search_description', ['searchText' => $searchText]));
        JsonLd::setDescription(__('search_description', ['searchText' => $searchText]));
        JsonLd::setType('SearchResultsPage');
    }
}
