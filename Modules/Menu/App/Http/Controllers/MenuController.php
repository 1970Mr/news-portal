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

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::with('parent')->latest()->paginate(10);
        return view('menu::index', compact('menus'));
    }

    public function create(): View
    {
        $parentMenus = Menu::query()->where('parent_id', null)->where('category_id', null)->get();
        $latestPosition = Menu::query()->latest('position')->first()?->position ?? 0;
        return view('menu::create-main-menu', compact(['parentMenus', 'latestPosition']));
    }

    public function store(MainMenuRequest $request): RedirectResponse
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

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('menu')]));
    }
}
