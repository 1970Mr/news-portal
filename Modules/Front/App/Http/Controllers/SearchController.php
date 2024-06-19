<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\SEOManager\App\Services\Front\SEOService;

class SearchController extends Controller
{
    public function __construct(private readonly SEOService $SEOService)
    {
    }

    public function __invoke(Request $request): View
    {
        $searchText = $request->get('query', $request->get('text'));
        $this->SEOService->setSearchPageSEO($searchText);
        $articles = Article::search($searchText)
            ->query(fn(Builder $query) => $query->with(['category', 'image', 'approvedComments', 'user']))
            ->paginate(10);
        if (!$searchText) {
            $searchText = __('all');
        }
        return view('front::search.index',
            compact(['searchText', 'articles']));
    }
}
