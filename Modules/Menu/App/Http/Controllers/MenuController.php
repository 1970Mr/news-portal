<?php

namespace Modules\Menu\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Menu\App\Http\Requests\MainMenuRequest;
use Modules\Menu\App\Models\Menu;
use Modules\Menu\App\Services\MenuService;

class MenuController extends Controller
{
    public function __construct(
        private readonly MenuService $menuService,
    )
    {
        $this->middleware('can:' . config('permissions_list.MENU_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.MENU_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.MENU_UPDATE', false))->only('update');
        $this->middleware('can:' . config('permissions_list.MENU_DESTROY', false))->only('destroy');
    }
    public function index(Request $request): View
    {
        $menus = $this->menuService->index($request);
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
        return to_route(config('app.panel_prefix', 'panel') . '.menus.index')
            ->with('success', __('entity_created', ['entity' => __('menu')]));
    }

    public function edit(Menu $menu): View
    {
        $parentMenus = Menu::query()->where('parent_id', null)->where('category_id', null)->get();
        $latestPosition = Menu::query()->latest('position')->first()?->position ?? 0;
        return view('menu::edit-main-menu', compact(['parentMenus', 'latestPosition', 'menu']));
    }

    public function update(MainMenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());
        return to_route(config('app.panel_prefix', 'panel') . '.menus.index')
            ->with('success', __('entity_edited', ['entity' => __('menu')]));
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('menu')]));
    }
}
