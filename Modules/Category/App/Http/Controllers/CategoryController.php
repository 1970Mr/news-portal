<?php

namespace Modules\Category\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Category\App\Http\Requests\CategoryRequest;
use Modules\Category\App\Models\Category;
use Modules\Category\App\Services\CategoryService;
use Modules\FileManager\App\Services\ImageService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
        $this->middleware('can:' . config('permissions_list.CATEGORY_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.CATEGORY_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.CATEGORY_UPDATE', false))->only('update');
        $this->middleware('can:' . config('permissions_list.CATEGORY_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $categories = $this->categoryService->index($request);
        return view('category::index', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::query()->where('parent_id', null)->latest()->active()->get();
        return view('category::create', compact('categories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->categoryService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.categories.index')->with('success', __('entity_created', ['entity' => __('category')]));
    }

    public function edit(Category $category): View
    {
        $categories = Category::query()->whereNot('id', $category->id)->where('parent_id', null)->latest()->active()->get();
        return view('category::edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->categoryService->update($request, $category);
        return to_route(config('app.panel_prefix', 'panel') . '.categories.index')->with('success', __('entity_edited', ['entity' => __('category')]));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('category')]));
    }
}
