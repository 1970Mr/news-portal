<?php

namespace Modules\Home\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Tag\App\Models\Tag;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $trending_posts['editor_choices'] = $this->baseQuery()->editorChoice()->limit(3)->get();
        if ($trending_posts['editor_choices']->count() < 3) {
            $trending_posts['editor_choices'] = $this->baseQuery()->limit(3)->get()->shuffle();
        }
        $articles_ids_ignore = $trending_posts['editor_choices']->pluck('id');
        $trending_posts['first_editor_choice'] = $trending_posts['editor_choices']->pop();

        $trending_posts['latest_articles'] = $this->baseQuery()->whereNotIn('id', $articles_ids_ignore)->limit(5)->get();
        if ($trending_posts['latest_articles']->count() < 1) {
            $trending_posts['latest_articles'] = $this->baseQuery()->limit(5)->get();
        }
        $articles_ids_ignore = $trending_posts['latest_articles']->pluck('id');

        $first_content['latest_articles'] = $this->baseQuery()->whereNotIn('id', $articles_ids_ignore)->limit(20)->get();
        if ($first_content['latest_articles']->count() < 3) {
            $first_content['latest_articles'] = $this->baseQuery()->limit(5)->get()->shuffle();
        }
        $articles_ids_ignore = $articles_ids_ignore->merge($first_content['latest_articles']->pluck('id'));

        $second_content['parent_categories'] = Category::with(['categories' => function ($query) {
            $query->whereHas('articles')->limit(6);
        }])->whereHas('categories.articles', function ($query) {
            $query->limit(5)->published();
        })->latest()->limit(5)->get();

        $third_content['categories'] = Category::with(['articles' => function ($query) {
            $query->limit(5)->published();
        }])->whereHas('articles')->where('parent_id', null)->latest()->limit(5)->get();

        $fourth_content['latest_articles'] = $this->baseQuery()->whereNotIn('id', $articles_ids_ignore)->limit(24)->get();

        $second_sidebar['latest_tags'] = Tag::query()->latest()->limit(30)->get();

        $footer['editor_choices'] = $this->baseQuery()->editorChoice()->limit(3)->get();
        $footer['hot_topics'] = Tag::with('hotness')->whereHas('hotness', function($query) {
            $query->where('is_hot', true);
        })->withCount('articles')->whereHas('articles')->latest()->limit(7)->get();



        $main_nav['parent_categories'] = Category::with(['categories' => function ($query) {
            $query->whereHas('articles')->limit(4);
        }])->whereHas('categories.articles', function ($query) {
            $query->limit(4)->published();
        })->latest()->limit(5)->get();
        $categories_ids_ignore = $main_nav['parent_categories']->pluck('id');

        $main_nav['categories_without_parent'] = Category::with(['articles' => function ($query) {
            $query->limit(4)->published();
        }])->whereHas('articles')->where('parent_id', null)->latest()->limit(5)->get();
        $categories_ids_ignore = $categories_ids_ignore->merge($main_nav['categories_without_parent']->pluck('id'));



        return view('home::index', compact([
            'main_nav',
            'trending_posts',
            'first_content',
            'second_content',
            'third_content',
            'fourth_content',
            'second_sidebar',
            'footer',
        ]));
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags'])->latest()->active()->published();
    }
}
