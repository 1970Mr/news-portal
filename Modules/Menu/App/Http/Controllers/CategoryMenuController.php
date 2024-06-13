<?php

namespace Modules\Menu\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Category\App\Models\Category;
use Modules\Menu\App\Http\Requests\CategoryMenuRequest;
use Modules\Menu\App\Http\Requests\MainMenuRequest;
use Modules\Menu\App\Models\Menu;

class CategoryMenuController extends Controller
{
    public function create(): View
    {
        $types = [Menu::TYPE_CATEGORY, Menu::TYPE_PARENT_CATEGORY];
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
        return to_route(config('app.panel_prefix', 'panel') . '.menus.index');
    }

    public function edit($id): View
    {
        return view('menu::edit');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }
}
