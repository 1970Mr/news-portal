<?php

namespace Modules\Article\App\Services\Front;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Menu\App\Models\Menu;
use Modules\Tag\App\Models\Tag;

class ArticleService
{
    public function __construct(private \Illuminate\Support\Collection $categoriesIdsIgnore) {}

    public function getLatestTags(): Collection
    {
        return Tag::query()->latest()->limit(30)->get();
    }

    public function getArticlesWithMostVisit(): array
    {
        $mostVisits = visits(Article::class)->top(4);
        if ($mostVisits->count() === 0) {
            $mostVisits = $this->baseQuery()->limit(4)->get();
        }
        $firstArticle = $mostVisits->shift();
        return [
            'first' => $firstArticle,
            'others' => $mostVisits,
        ];
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
            $query->whereHas('articles', function ($query) {
                $query->published()->active();
            });
        }])
            ->whereHas('categories.articles', function ($query) {
                $query->published()->active();
            })
            ->active()
            ->latest('updated_at')
            ->limit(3)
            ->get();

        // Set limit for each category articles
        $categories->each(function ($category) {
            $category->setRelation('categories', $category->categories->take(5));
            $category->categories->each(function ($childCategory) {
                $childCategory->setRelation('articles', $childCategory->articles->take(4));
            });
        });

        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge($categories->pluck('id'));
        return $categories;
    }

    public function getCategoriesWithoutParent(): Collection
    {
        $categories = Category::with(['articles' => function ($query) {
            $query->published()->active();
        }])
            ->whereHas('articles', function ($query) {
                $query->published()->active();
            })
            ->where('parent_id', null)
            ->active()
            ->latest('updated_at')
            ->limit(3)
            ->get();

        // Set limit for each category articles
        $categories->each(function ($category) {
            $category->articles = $category->articles->take(4);
        });

        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge($categories->pluck('id'));
        return $categories;
    }

    public function getOtherParentCategories(): Collection
    {
        $categories = Category::with(['categories' => function ($query) {
            $query->whereHas('articles');
        }])
            ->whereHas('categories.articles')
            ->whereNotIn('id', $this->categoriesIdsIgnore)
            ->active()
            ->latest()
            ->get();
        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge($categories->pluck('id'));
        return $categories;
    }

    public function getOtherCategoriesWithoutParent(): Collection
    {
        $categories = Category::query()
            ->whereHas('articles')
            ->where('parent_id', null)
            ->whereNotIn('id', $this->categoriesIdsIgnore)
            ->active()
            ->latest()
            ->get();
        $this->categoriesIdsIgnore = $this->categoriesIdsIgnore->merge($categories->pluck('id'));
        return $categories;
    }

    public function composeViewData(): array
    {
        $trending_bar = [
            'hot_articles' => Cache::remember('hot_articles', 60 * 60, function () {
                return $this->getHotArticles();
            }),
        ];

        $main_nav = [
            'menus' => Menu::query()->latest('position')->get(),
            'parent_categories' => Cache::remember('parent_categories', 60 * 60, function () {
                return $this->getParentCategories();
            }),
            'categories_without_parent' => Cache::remember('categories_without_parent', 60 * 60, function () {
                return $this->getCategoriesWithoutParent();
            }),
            'other_categories' => [
                'parent_categories' => Cache::remember('other_parent_categories', 60 * 60, function () {
                    return $this->getOtherParentCategories();
                }),
                'categories_without_parent' => Cache::remember('other_categories_without_parent', 60 * 60, function () {
                    return $this->getOtherCategoriesWithoutParent();
                }),
            ],
        ];

        $first_sidebar = [
            'articles_with_most_visits' => Cache::remember('articles_with_most_visits', 60 * 60, function () {
                return $this->getArticlesWithMostVisit();
            }),
        ];

        $second_sidebar = [
            'latest_tags' => Cache::remember('latest_tags', 60 * 60, function () {
                return $this->getLatestTags();
            }),
        ];

        $footer = [
            'editor_choices' => Cache::remember('editor_choices', 60 * 60, function () {
                return $this->getEditorChoices();
            }),
            'hot_topics' => Cache::remember('hot_topics', 60 * 60, function () {
                return $this->getHotTopics();
            }),
            'articles_with_most_comments' => Cache::remember('articles_with_most_comments', 60 * 60, function () {
                return $this->getArticleWithMostComments();
            }),
        ];

        return compact(['trending_bar', 'main_nav', 'second_sidebar', 'first_sidebar', 'footer']);
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags', 'user'])->latest()->active()->published();
    }
}
