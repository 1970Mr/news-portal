<?php

namespace Modules\Article\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Article\App\Http\Requests\ArticleRequest;
use Modules\Article\App\Models\Article;
use Modules\Article\App\Services\ArticleService;
use Modules\Category\App\Models\Category;
use Modules\Tag\App\Models\Tag;

class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleService $articleService,
    )
    {
        $this->middleware('can:' . config('permissions_list.ARTICLE_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.ARTICLE_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.ARTICLE_UPDATE', false))->only('update');
        $this->middleware('can:' . config('permissions_list.ARTICLE_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $articles = $this->articleService->index($request);
        return view('article::index', compact('articles'));
    }

    public function create(): View
    {
        $categories = Category::query()->active()->latest()->get();
        $tags = Tag::query()->active()->latest()->get();
        return view('article::create', compact('categories', 'tags'));
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->articleService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.articles.index')->with('success', __('entity_created', ['entity' => __('article')]));
    }

    public function edit(Article $article): View
    {
        $categories = Category::query()->active()->latest()->get();
        $tags = Tag::query()->active()->latest()->get();
        return view('article::edit', compact('categories', 'tags', 'article'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $this->articleService->update($request, $article);
        return to_route(config('app.panel_prefix', 'panel') . '.articles.index')->with('success', __('entity_edited', ['entity' => __('article')]));
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->destroy($article);
        return back()->with('success', __('entity_deleted', ['entity' => __('article')]));
    }

    public function SEOSettings(Article $article): view
    {
        $nextUrl  = config('app.panel_prefix', 'panel') . '.articles.index';
        $title = $article->title;
        $pageTitle = __('article') . ' ' . $title;
        // Optional placeholder
        $canonicalUrl = route('news.show', [$article->category->slug, $article->slug]);
        return view('seo-manager::seo-settings', compact(['nextUrl', 'title', 'canonicalUrl', 'pageTitle']) + ['model' => $article]);
    }
}
