<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Home\App\Services\HomeService;
use Modules\SEOManager\App\Services\Front\SEOService;

class HomeController extends Controller
{
    public function __construct(private readonly HomeService $homeService, private readonly SEOService $seoService) {}

    public function __invoke(): View
    {
        $this->seoService->setHomePageSEO();

        $trendingPosts = $this->homeService->getTrendingPosts();
        $articlesIdsIgnore = $trendingPosts['editor_choices']->pluck('id');
        $trendingPosts['first_editor_choice'] = $trendingPosts['editor_choices']->pop();

        $trendingPosts['latest_articles'] = $this->homeService->getLatestArticles($articlesIdsIgnore);
        $articlesIdsIgnore = $trendingPosts['latest_articles']->pluck('id');

        $firstContent['latest_articles'] = $this->homeService->getFirstContentArticles($articlesIdsIgnore);
        $articlesIdsIgnore = $articlesIdsIgnore->merge($firstContent['latest_articles']->pluck('id'));

        $secondContent['parent_categories'] = $this->homeService->getParentCategories();
        $thirdContent['categories'] = $this->homeService->getCategoriesWithoutParent();
        $fourthContent['latest_articles'] = $this->homeService->getFourthContentArticles($articlesIdsIgnore);

        return view('home::index', [
            'trending_posts' => $trendingPosts,
            'first_content' => $firstContent,
            'second_content' => $secondContent,
            'third_content' => $thirdContent,
            'fourth_content' => $fourthContent,
        ]);
    }
}
