<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $trending_posts['five_latest_article'] = Article::with(['hotness', 'image', 'category', 'tags'])->latest()->limit(5)->get();
        return view('home::index', compact([
            'trending_posts',
        ]));
    }
}
