<?php

namespace Modules\SEOManager\App\Services\Front;

use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\PageBuilder\App\Models\Page;
use Modules\Tag\App\Models\Tag;
use Modules\User\App\Models\User;

class SEOService
{
    public function __construct(
        protected HomePageSEOService       $homePageSEOService,
        protected ArticlePageSEOService    $articlePageSEOService,
        protected AuthorPageSEOService     $authorPageSEOService,
        protected AboutUsPageSEOService    $aboutUsPageSEOService,
        protected ContactUsPageSEOService  $contactUsPageSEOService,
        protected CategoriesPageSEOService $categoriesPageSEOService,
        protected TagPageSEOService        $tagPageSEOService,
        protected SearchPageSEOService     $searchPageSEOService,
        protected PageSEOService           $pageSEOService,
    )
    {
    }

    public function setHomePageSEO(): void
    {
        $this->homePageSEOService->setHomePageSEO();
    }

    public function setArticlePageSEO(Article $article): void
    {
        $this->articlePageSEOService->setArticlePageSEO($article);
    }

    public function setAuthorPageSEO(User $author): void
    {
        $this->authorPageSEOService->setAuthorPageSEO($author);
    }

    public function setAboutUsPageSEO(): void
    {
        $this->aboutUsPageSEOService->setAboutUsPageSEO();
    }

    public function setContactUsPageSEO(): void
    {
        $this->contactUsPageSEOService->setContactUsPageSEO();
    }

    public function setCategoryPageSEO(Category $category): void
    {
        $this->categoriesPageSEOService->setCategoryPageSEO($category);
    }

    public function setCategoriesPageSEO(): void
    {
        $this->categoriesPageSEOService->setCategoriesPageSEO();
    }

    public function setTagPageSEO(Tag $tag): void
    {
        $this->tagPageSEOService->setTagPageSEO($tag);
    }

    public function setSearchPageSEO(string $searchText): void
    {
        $this->searchPageSEOService->setSearchPageSEO($searchText);
    }

    public function setPageSEO(Page $page): void
    {
        $this->pageSEOService->setPageSEO($page);
    }
}
