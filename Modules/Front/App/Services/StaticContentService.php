<?php

namespace Modules\Front\App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\MenuBuilder\App\Models\Menu;
use Modules\Tag\App\Models\Tag;

class StaticContentService
{
    private const CACHE_TTL = 60 * 60 * 3;

    public function composeViewData(): array
    {
        $trending_bar = [
            'hot_articles' => $this->getHotArticles(),
        ];

        $main_nav = [
            'menus' => $this->getMenus(),
            'categories' => $this->getCategories(),
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

    public function getHotArticles(): Collection
    {
        return Cache::remember('hot_articles', self::CACHE_TTL, function () {
            $articles = $this->baseQuery()
                ->whereHas('hotness', function ($query) {
                    $query->where('is_hot', true);
                })
                ->limit(15)
                ->get();

            if ($articles->count() <= 0) {
                $articles = $this->baseQuery()->limit(10)->get();
            }

            return $articles;
        });
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags', 'user'])->latest()->active()->published();
    }

    public function getMenus(): Collection
    {
        return Cache::remember('menus', self::CACHE_TTL, static function () {
            $mainMenus = Menu::mainMenus()->active()->get()->pluck('id')->toArray();
            $mainMenusWithChildren = Menu::mainMenusWithChildren()->active()->get()->pluck('id')->toArray();
            $categoryMenus = Menu::categoryMenus()->active()->get()->pluck('id')->toArray();
            $parentCategoryMenus = Menu::parentCategoryMenus()->active()->get()->pluck('id')->toArray();
            $ignoreIds = array_merge($mainMenus, $mainMenusWithChildren, $categoryMenus, $parentCategoryMenus);

            $menus = Menu::with(['parent', 'children', 'category'])
                ->whereIn('id', $ignoreIds)
                ->latest('position')
                ->active()
                ->get();

            // Set limit for each category articles
            $menus->each(function ($menu) {
                if ($menu?->category !== null) {
                    $menu->category->setRelation('articles', $menu->category->articles->take(4));

                    $menu->category->setRelation('categories', $menu->category->categories->take(5));
                    $menu->category->categories->each(function ($childCategory) {
                        $childCategory->setRelation('articles', $childCategory->articles->take(4));
                    });
                }
            });

            return $menus;
        });
    }

    public function getCategories(): Collection
    {
        return Cache::remember('categories', self::CACHE_TTL, function () {
            return Category::query()
                ->whereHas('articles', function (Builder $query) {
                    $query->active()->published();
                })
                ->parentCategories()
                ->withCount('articles')
                ->latest('articles_count')
                ->active()
                ->get();
        });
    }

    public function getArticlesWithMostVisit(): array
    {
        return Cache::remember('articles_with_most_visits', self::CACHE_TTL, function () {
            $mostVisits = visits(Article::class)->top(4);
            if ($mostVisits->count() === 0) {
                $mostVisits = $this->baseQuery()->limit(4)->get();
            }
            $firstArticle = $mostVisits->shift();
            return [
                'first' => $firstArticle,
                'others' => $mostVisits,
            ];
        });
    }

    public function getLatestTags(): Collection
    {
        return Cache::remember('latest_tags', self::CACHE_TTL, function () {
            return Tag::query()->latest()->limit(30)->get();
        });
    }

    public function getEditorChoices(): Collection
    {
        return Cache::remember('editor_choices', self::CACHE_TTL, function () {
            return $this->baseQuery()->editorChoice()->limit(3)->get();
        });
    }

    public function getHotTopics(): Collection
    {
        return Cache::remember('hot_topics', self::CACHE_TTL, function () {
            return Tag::with('hotness')
                ->whereHas('hotness', function ($query) {
                    $query->where('is_hot', true);
                })
                ->withCount('articles')
                ->whereHas('articles')
                ->latest()
                ->limit(7)
                ->get();
        });
    }

    public function getArticleWithMostComments(): Collection
    {
        return Cache::remember('articles_with_most_comments', self::CACHE_TTL, function () {
            return Article::with(['hotness', 'image', 'category', 'tags', 'user'])->active()->published()
                ->withCount('approvedComments')
                ->orderBy('approved_comments_count', 'desc')
                ->limit(3)
                ->get();
        });
    }
}
