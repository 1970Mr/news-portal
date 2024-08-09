<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Category\App\Models\Category;
use Modules\SEOManager\App\Services\Front\SEOService;

class CategoryController extends Controller
{
    public function __construct(private readonly SEOService $SEOService) {}

    public function index(): View
    {
        $this->SEOService->setCategoriesPageSEO();
        $categories = Category::with('image')->withCount('articles')->latest('articles_count')->paginate(10);

        return view('front::category.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $this->SEOService->setCategoryPageSEO($category);
        $subCategories = $category->categories()->latest()->get();
        $articles = $category->articles()->with(['category', 'image', 'approvedComments', 'user'])->paginate(10);

        return view(
            'front::category.show',
            compact(['category', 'subCategories', 'articles'])
        );
    }
}
