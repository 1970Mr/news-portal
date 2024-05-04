<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jorenvh\Share\ShareFacade;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;

class ArticleController extends Controller
{

    public function show(Request $request, Category $category, Article $article): View
    {
        $shared_links = ShareFacade::page($request->url(), $article->title)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->pinterest()
            ->getRawLinks();

        $previous_article = Article::with('category')->where('created_at', '<', $article->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $next_article = Article::with('category')->where('created_at', '>', $article->created_at)
            ->orderBy('created_at')
            ->first();

        $related_articles = $article->category->articles()->with(['image', 'category', 'user'])->where('id', '!=', $article->id)->latest()->limit(6)->get();

        if ($related_articles->count() < 3) {
            $related_articles = Article::with(['image', 'category', 'user'])->where('id', '!=', $article->id)->latest()->limit(6)->get()->shuffle();
        }

        return view('front::single-post.index', compact(['article', 'category', 'shared_links', 'previous_article', 'next_article', 'related_articles']));
    }
}
