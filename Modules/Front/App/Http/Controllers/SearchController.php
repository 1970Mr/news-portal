<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Article\App\Models\Article;
use Modules\Common\App\Services\SEOService;

class SearchController extends Controller
{
    public function __construct(private readonly SEOService $SEOService) {}

    public function __invoke(Request $request): View
    {
        $searchText = $request->text;
        $this->SEOService->setSearchPageSEO($searchText);
        $articleIds = Article::search($searchText)->get()->pluck('id');
        $articles = Article::with(['category', 'image', 'approvedComments', 'user'])
            ->whereIn('id', $articleIds)
            ->paginate(10);
        if (!$searchText) {
            $searchText = __('all');
        }
        return view('front::search.index',
            compact(['searchText', 'articles']));
    }
}
