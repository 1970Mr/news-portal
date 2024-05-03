<?php

namespace Modules\Front\App\Services;

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
        return Tag::latest()->limit(30)->get();
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
        $main_nav = [
            'parent_categories' => $this->getParentCategories(),
            'categories_without_parent' => $this->getCategoriesWithoutParent(),
            'other_categories' => [
                'parent_categories' => $this->getOtherParentCategories(),
                'categories_without_parent' => $this->getOtherCategoriesWithoutParent(),
            ],
        ];

        $footer = [
            'editor_choices' => $this->getEditorChoices(),
            'hot_topics' => $this->getHotTopics(),
        ];

        $second_sidebar = [
            'latest_tags' => $this->getLatestTags(),
        ];

        return compact(['main_nav', 'footer', 'second_sidebar']);
    }

    private function baseQuery(): Builder
    {
        return Article::with(['hotness', 'image', 'category', 'tags'])->latest()->active()->published();
    }
}
