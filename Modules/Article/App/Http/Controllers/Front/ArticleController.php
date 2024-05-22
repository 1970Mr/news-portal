<?php

namespace Modules\Article\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jorenvh\Share\ShareFacade;
use Modules\Article\App\Models\Article;
use Modules\Article\App\Services\Front\ShareService;
use Modules\Category\App\Models\Category;
use Modules\Comment\App\Services\SEOService;

class ArticleController extends Controller
{
    public function __construct(private readonly SEOService $seoService, private readonly ShareService $shareService) {}

    public function show(Request $request, Category $category, Article $article): View
    {
        $this->seoService->setArticlePageSEO($article);
        $shared_links = $this->shareService->generateSharedLinks($request->url(), $article->title);
        $previous_article = $article->previousArticle();
        $next_article = $article->nextArticle();
        $related_articles = $article->relatedArticles();
        visits($article)->increment();
        return view('front::single-article.show', compact(['article', 'category', 'shared_links', 'previous_article', 'next_article', 'related_articles']));
    }
}
