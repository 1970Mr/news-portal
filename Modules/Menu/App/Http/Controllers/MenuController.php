<?php

namespace Modules\Menu\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
        return view('menu::create');
    }

    public function store(Request $request): RedirectResponse
    {
        //
    }

    public function edit($id): View
    {
        return view('menu::edit');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        //
    }
}
