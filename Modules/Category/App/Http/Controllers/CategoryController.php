<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Category\App\Http\Requests\CategoryStoreRequest;
use Modules\Category\App\Http\Requests\CategoryUpdateRequest;
use Modules\Category\App\Models\Category;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('category::index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('category::create', compact('categories'));
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return to_route('category.index')->with('success', __('category::messages.category_created'));
    }

    public function edit(Category $category): View
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('category::edit', compact('category', 'categories'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return to_route('category.index')->with('success', __('category::messages.category_edited', ['name' => $request->name]));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return to_route('category.index')->with('success', __('category::messages.category_deleted'));
    }
}
