<?php

namespace Modules\Panel\App\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\User\App\Models\User;

class PanelService
{
    public function getLimitedData(string $model, int $limit = 5, array $relations = []): Collection
    {
        return $model::with($relations)->latest()->limit($limit)->get();
    }

    public function getDataCounts(): array
    {
        return [
            'users_count' => User::count(),
            'articles_count' => Article::count(),
            'categories_count' => Category::count(),
        ];
    }

    public function getArticlesVisitsCount(): array
    {
        $articlesVisitsCount['all'] = visits(Article::class)->count();
        $articlesVisitsCount['year'] = visits(Article::class)->period('year')->count();
        $articlesVisitsCount['month'] = visits(Article::class)->period('month')->count();
        $articlesVisitsCount['week'] = visits(Article::class)->period('week')->count();
        $articlesVisitsCount['day'] = visits(Article::class)->period('day')->count();
        $articlesVisitsCount['10hours'] = visits(Article::class)->period('10hours')->count();
        $articlesVisitsCount['hour'] = visits(Article::class)->period('hour')->count();

        return $articlesVisitsCount;
    }
}
