<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Category\App\Http\Requests\CategoryRequest;
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
        return view('category::create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return to_route('category.index')->with('success', 'دسته بندی جدید با موفقیت ایجاد شد');
    }

    public function edit(Category $category): View
    {
        return view('category::edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return to_route('category.index')->with('success', "دسته بندی " . $category->title . " با موفقیت ویرایش شد");
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('category.index')->with('success', 'حذف دسته بندی با موفقیت انجام شد.');
    }
}
