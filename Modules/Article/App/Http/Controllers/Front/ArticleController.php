<?php

namespace Modules\Article\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\Article\App\Services\Front\ShareService;
use Modules\Category\App\Models\Category;
use Modules\SEOManager\App\Services\Front\SEOService;

class ArticleController extends Controller
{
    public function __construct(private readonly SEOService $seoService, private readonly ShareService $shareService) {}

    // For article
    public function show(Article $article, Request $request): View
    {
        $this->seoService->setArticlePageSEO($article);
        $shared_links = $this->shareService->generateSharedLinks($request->url(), $article->title);
        $previous_article = $article->previousArticle();
        $next_article = $article->nextArticle();
        $related_articles = $article->relatedArticles();
        visits($article)->increment();
        return view('front::single-article.show', compact(['article', 'shared_links', 'previous_article', 'next_article', 'related_articles']));
    }

    // For news
    public function showNews(Request $request, string $date, Article $article): View
    {
        return $this->show($article, $request);
    }

    public function like(Article $article): RedirectResponse
    {
        $article->like();
        return redirect()->back()->with('success', __('article::messages.liked'));
    }

    public function unlike(Article $article): RedirectResponse
    {
        $article->unlike();
        return redirect()->back()->with('success', __('article::messages.unliked'));
    }
}
