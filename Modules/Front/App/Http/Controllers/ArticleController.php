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

        return view('front::single-post.index', compact(['article', 'category', 'shared_links']));
    }
}
