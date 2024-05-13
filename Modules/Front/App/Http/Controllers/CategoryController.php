<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Category\App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        $subCategories = $category->categories()->latest()->get();
        $articles = $category->articles()->with(['category', 'image', 'approvedComments', 'user',])->paginate(10);
        abort_if($articles->count() < 1, 404);
        return view('front::category.index',
            compact(['category', 'subCategories', 'articles']));
    }
}
