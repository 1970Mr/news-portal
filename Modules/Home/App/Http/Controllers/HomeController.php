<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $ids_ignore = collect([]);
        $default_value = Article::with(['hotness', 'image', 'category', 'tags'])->limit(5)->active()->published();

        $trending_posts['editor_choices'] = Article::with(['hotness', 'image', 'category', 'tags'])->latest()->limit(3)->active()->published()->editorChoice()->get();
        if ($trending_posts['editor_choices']->count() < 3) {
            $trending_posts['editor_choices'] = $default_value->latest()->get()->shuffle()->take(3);
        }
        $ids_ignore = $ids_ignore->merge($trending_posts['editor_choices']->pluck('id'));
        $trending_posts['first_editor_choice'] = $trending_posts['editor_choices']->pop();

        $trending_posts['five_latest_articles'] = Article::with(['hotness', 'image', 'category', 'tags'])->whereNotIn('id', $ids_ignore)->latest()->limit(5)->active()->published()->get();
        if ($trending_posts['five_latest_articles']->count() < 1) {
            $trending_posts['five_latest_articles'] = $default_value->get();
        }
        $ids_ignore = $ids_ignore->merge($trending_posts['five_latest_articles']->pluck('id'));

        return view('home::index', compact([
            'trending_posts',
        ]));
    }
}
