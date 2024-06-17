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
        $categories = Category::with(['categories' => function ($query) {
            $query->whereHas('articles', function ($query) {
                $query->published()->active();
            });
        }])->whereHas('categories.articles', function ($query) {
            $query->published()->active();
        })->active()->latest()->limit(6)->get();

        // Set limit for each category articles
        $categories->each(function ($category) {
            $category->setRelation('categories', $category->categories->take(6));
            $category->categories->each(function ($childCategory) {
                $childCategory->setRelation('articles', $childCategory->articles->take(4));
            });
        });

        return $categories;
    }

    public function getCategoriesWithoutParent(): Collection
    {
        $categories = Category::with(['articles' => function ($query) {
            $query->published()->active();
        }])->whereHas('articles', function ($query) {
            $query->published()->active();
        })
            ->where('parent_id', null)->active()->latest()->limit(15)->get();

        // Set limit for each category articles
        $categories->each(function ($category) {
            $category->setRelation('articles', $category->articles->take(4));
        });

        return $categories;
    }

    public function getFourthContentArticles($articlesIdsIgnore): Collection
    {
        return $this->baseQuery()->whereNotIn('id', $articlesIdsIgnore)->limit(24)->get();
    }
}
