<?php

namespace Modules\Menu\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Category\App\Models\Category;
use Modules\Menu\App\Http\Requests\CategoryMenuRequest;
use Modules\Menu\App\Models\Menu;

class CategoryMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . config('permissions_list.MENU_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.MENU_UPDATE', false))->only('update');
    }

    public function create(): View
    {
        $types = [Menu::CATEGORY_TYPE, Menu::PARENT_CATEGORY_TYPE];
        $categoriesWithMenus = Menu::query()->whereNotNull('category_id')->pluck('category_id')->toArray();
        $categories = Category::query()
            ->whereNotIn('id', $categoriesWithMenus)
            ->latest()
            ->get();
        $latestPosition = Menu::query()->latest('position')->first()?->position ?? 0;
        return view('menu::create-category-menu', compact(['categories', 'latestPosition', 'types']));
    }

    public function store(CategoryMenuRequest $request): RedirectResponse
    {
        Menu::query()->create($request->validated());
        return to_route(config('app.panel_prefix', 'panel') . '.menus.index')
            ->with('success', __('entity_created', ['entity' => __('menu')]));
    }

    public function edit(Menu $menu): View
    {
        $types = [Menu::CATEGORY_TYPE, Menu::PARENT_CATEGORY_TYPE];
        $categoriesWithMenus = Menu::query()->whereNotNull('category_id')
            ->whereNot('category_id', $menu->category->id)->pluck('category_id')->toArray();
        $categories = Category::query()
            ->whereNotIn('id', $categoriesWithMenus)
            ->latest()
            ->get();
        $latestPosition = Menu::query()->latest('position')->first()?->position ?? 0;
        return view('menu::edit-category-menu', compact(['categories', 'latestPosition', 'types', 'menu']));
    }

    public function update(CategoryMenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());
        return to_route(config('app.panel_prefix', 'panel') . '.menus.index')
            ->with('success', __('entity_edited', ['entity' => __('menu')]));
    }
}
