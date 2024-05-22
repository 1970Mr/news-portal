<?php

namespace Modules\Comment\App\Services;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Modules\Setting\App\Models\SiteDetail;

class SEOService
{
    public function setHomePageSEO(): void
    {
        $siteDetails = SiteDetail::with('headerLogo')->first();
        $siteTitle = __('news agency') . ' ' . config('app.name') . ' - ' . __('independent and reliable news site');

        SEOTools::setTitle($siteTitle);
        SEOTools::setDescription(__('site_description'));
        SEOTools::opengraph()->setUrl(route('home.index'));
        SEOTools::setCanonical(route('home.index'));
        SEOTools::opengraph()->addProperty('type', 'website');

        if ($siteDetails && $siteDetails->headerLogo) {
            SEOTools::jsonLd()->addImage(asset('storage/' . $siteDetails->headerLogo->file_path));
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
}
