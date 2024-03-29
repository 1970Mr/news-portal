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
    public function __construct()
    {
        $this->middleware('can:' . config('permissions_list.CATEGORY_INDEX'))->only('index');
        $this->middleware('can:' . config('permissions_list.CATEGORY_STORE'))->only('store');
        $this->middleware('can:' . config('permissions_list.CATEGORY_UPDATE'))->only('update');
        $this->middleware('can:' . config('permissions_list.CATEGORY_DESTROY'))->only('destroy');
    }

    public function index(): View
    {
        $categories = Category::latest()->paginate(10);
        return view('category::index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::latest()->get();
        return view('category::create', compact('categories'));
    }

    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return to_route('category.index')->with('success', __('entity_created', ['entity' => __('category')]));
    }

    public function edit(Category $category): View
    {
        $categories = Category::latest()->get();
        return view('category::edit', compact('category', 'categories'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return to_route('category.index')->with('success', __('entity_edited', ['entity' => __('category'), 'name' => $request->name]));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return to_route('category.index')->with('success', __('entity_deleted', ['entity' => __('category')]));
    }
}
