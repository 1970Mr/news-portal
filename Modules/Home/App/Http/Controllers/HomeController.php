<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $trending_posts['editor_choices'] = $this->baseQuery()->editorChoice()->limit(3)->get();
        if ($trending_posts['editor_choices']->count() < 3) {
            $trending_posts['editor_choices'] = $this->baseQuery()->get()->shuffle()->take(3);
        }
        $ids_ignore = $trending_posts['editor_choices']->pluck('id');
        $trending_posts['first_editor_choice'] = $trending_posts['editor_choices']->pop();

        $trending_posts['five_latest_articles'] = $this->baseQuery()->whereNotIn('id', $ids_ignore)->limit(5)->get();
        if ($trending_posts['five_latest_articles']->count() < 1) {
            $trending_posts['five_latest_articles'] = $this->baseQuery()->limit(5)->get();
        }
        return view('home::index', compact('trending_posts'));
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags'])->latest()->active()->published();
    }
}
