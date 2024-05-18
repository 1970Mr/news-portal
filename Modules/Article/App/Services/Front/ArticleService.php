<?php

namespace Modules\Article\App\Services\Front;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Tag\App\Models\Tag;

class ArticleService
{
    public function __construct(private \Illuminate\Support\Collection $categoriesIdsIgnore) {}

    public function getLatestTags(): Collection
    {
        return Tag::query()->latest()->limit(30)->get();
    }

    public function getArticlesWithMostVisit(): \Illuminate\Support\Collection
    {
        return visits(Article::class)->top(4);
    }

    public function getEditorChoices(): Collection
    {
        return $this->baseQuery()->editorChoice()->limit(3)->get();
    }

    public function getHotTopics(): Collection
    {
        return Tag::with('hotness')
            ->whereHas('hotness', function ($query) {
                $query->where('is_hot', true);
            })
            ->withCount('articles')
            ->whereHas('articles')
            ->latest()
            ->limit(7)
            ->get();
    }

    public function getHotArticles(): Collection
    {
        $articles = $this->baseQuery()
            ->whereHas('hotness', function ($query) {
                $query->where('is_hot', true);
            })
            ->limit(15)
            ->get();

        if ($articles->count() <= 0) {
            $this->baseQuery()->limit(10)->get();
        }

        return $articles;
    }

    public function getArticleWithMostComments(): Collection
    {
        return Article::with(['hotness', 'image', 'category', 'tags', 'user'])->active()->published()
            ->withCount('approvedComments')
            ->orderBy('approved_comments_count', 'desc')
            ->limit(3)
            ->get();
    }

    public function getParentCategories(): Collection
    {
        $categories = Category::with(['categories' => function ($query) {
            $query->whereHas('articles')->limit(4);
        }])
            ->whereHas('categories.articles', function ($query) {
                $query->limit(4)->published();
            })
            ->latest()
            ->limit(5)
            ->get();
        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge( $categories->pluck('id') );
        return $categories;
    }

    public function getCategoriesWithoutParent(): Collection
    {
        $categories = Category::with(['articles' => function ($query) {
            $query->limit(4)->published();
        }])
            ->whereHas('articles')
            ->where('parent_id', null)
            ->latest()
            ->limit(5)
            ->get();
        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge( $categories->pluck('id') );
        return $categories;
    }

    public function getOtherParentCategories(): Collection
    {
        $categories = Category::with(['categories' => function ($query) {
            $query->whereHas('articles');
        }])
            ->whereHas('categories.articles')
            ->whereNotIn('id', $this->categoriesIdsIgnore)
            ->latest()
            ->get();
        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge( $categories->pluck('id') );
        return $categories;
    }

    public function getOtherCategoriesWithoutParent(): Collection
    {
        $categories = Category::query()
            ->whereHas('articles')
            ->where('parent_id', null)
            ->whereNotIn('id', $this->categoriesIdsIgnore)
            ->latest()
            ->get();
        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge( $categories->pluck('id') );
        return $categories;
    }

    public function composeViewData(): array
    {
        $trending_bar = [
            'hot_articles' => $this->getHotArticles(),
        ];

        $main_nav = [
            'parent_categories' => $this->getParentCategories(),
            'categories_without_parent' => $this->getCategoriesWithoutParent(),
            'other_categories' => [
                'parent_categories' => $this->getOtherParentCategories(),
                'categories_without_parent' => $this->getOtherCategoriesWithoutParent(),
            ],
        ];

        $first_sidebar = [
            'articles_with_most_visits' => $this->getArticlesWithMostVisit(),
        ];

        $second_sidebar = [
            'latest_tags' => $this->getLatestTags(),
        ];

        $footer = [
            'editor_choices' => $this->getEditorChoices(),
            'hot_topics' => $this->getHotTopics(),
            'articles_with_most_comments' => $this->getArticleWithMostComments(),
        ];

        return compact(['trending_bar', 'main_nav', 'second_sidebar', 'first_sidebar', 'footer']);
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags', 'user'])->latest()->active()->published();
    }
}
