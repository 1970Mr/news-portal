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

    public function getVisitorsCount(): array
    {
        $visitorsCount['all'] = visits(Article::class)->count();
        $visitorsCount['year'] = visits(Article::class)->period('year')->count();
        $visitorsCount['month'] = visits(Article::class)->period('month')->count();
        $visitorsCount['week'] = visits(Article::class)->period('week')->count();
        $visitorsCount['day'] = visits(Article::class)->period('day')->count();
        $visitorsCount['hour'] = visits(Article::class)->period('hour')->count();
        return $visitorsCount;
    }
}
