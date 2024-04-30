<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $trending_posts['editor_choices'] = $this->baseQuery()->editorChoice()->limit(3)->get();
        if ($trending_posts['editor_choices']->count() < 3) {
            $trending_posts['editor_choices'] = $this->baseQuery()->limit(3)->get()->shuffle();
        }
        $ids_ignore = $trending_posts['editor_choices']->pluck('id');
        $trending_posts['first_editor_choice'] = $trending_posts['editor_choices']->pop();

        $trending_posts['latest_articles'] = $this->baseQuery()->whereNotIn('id', $ids_ignore)->limit(5)->get();
            if ($trending_posts['latest_articles']->count() < 1) {
            $trending_posts['latest_articles'] = $this->baseQuery()->limit(5)->get();
        }
        $ids_ignore = $trending_posts['latest_articles']->pluck('id');

        $first_content['latest_articles'] = $this->baseQuery()->whereNotIn('id', $ids_ignore)->limit(20)->get();
        if ($first_content['latest_articles']->count() < 3) {
            $first_content['latest_articles'] = $this->baseQuery()->limit(5)->get()->shuffle();
        }

        $second_content['parent_categories'] = Category::with(['categories' => function ($query) {
            $query->whereHas('articles')->limit(6);
        }])->whereHas('categories.articles', function ($query) {
            $query->limit(5)->published();
        })->latest()->limit(5)->get();

        $third_content['categories'] = Category::with(['articles' => function ($query) {
            $query->limit(5)->published();
        }])->whereHas('articles')->where('parent_id', null)->latest()->limit(5)->get();

        return view('home::index', compact('trending_posts', 'first_content', 'second_content', 'third_content'));
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags'])->latest()->active()->published();
    }
}
