<?php

namespace Modules\Home\App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;

class HomeService
{
    public function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags'])->latest()->active()->published();
    }

    public function getTrendingPosts(): array
    {
        $editorChoices = $this->baseQuery()->editorChoice()->limit(3)->get();
        if ($editorChoices->count() < 3) {
            $editorChoices = $this->baseQuery()->limit(3)->get()->shuffle();
        }

        return ['editor_choices' => $editorChoices];
    }

    public function getLatestArticles($articlesIdsIgnore): Collection
    {
        $latestArticles = $this->baseQuery()->whereNotIn('id', $articlesIdsIgnore)->limit(5)->get();
        if ($latestArticles->count() < 1) {
            $latestArticles = $this->baseQuery()->limit(5)->get();
        }

        return $latestArticles;
    }

    public function getFirstContentArticles($articlesIdsIgnore): Collection
    {
        $latestArticles = $this->baseQuery()->whereNotIn('id', $articlesIdsIgnore)->limit(20)->get();
        if ($latestArticles->count() < 3) {
            $latestArticles = $this->baseQuery()->limit(5)->get()->shuffle();
        }

        return $latestArticles;
    }

    public function getParentCategories(): Collection
    {
        return Category::with(['categories' => function ($query) {
            $query->whereHas('articles')->limit(6);
        }])->whereHas('categories.articles', function ($query) {
            $query->limit(5)->published();
        })->latest()->limit(5)->get();
    }

    public function getCategoriesWithoutParent(): Collection
    {
        return Category::with(['articles' => function ($query) {
            $query->limit(5)->published();
        }])->whereHas('articles')->where('parent_id', null)->latest()->limit(5)->get();
    }

    public function getFourthContentArticles($articlesIdsIgnore): Collection
    {
        return $this->baseQuery()->whereNotIn('id', $articlesIdsIgnore)->limit(24)->get();
    }
}
