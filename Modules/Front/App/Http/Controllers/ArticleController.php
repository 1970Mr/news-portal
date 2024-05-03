<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;

class ArticleController extends Controller
{

    public function show(Category $category, Article $article): View
    {
        return view('front::single-post.index', compact(['article', 'category']));
    }
}
