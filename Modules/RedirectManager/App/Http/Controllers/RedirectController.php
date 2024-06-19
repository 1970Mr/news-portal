<?php

namespace Modules\RedirectManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\RedirectManager\App\Http\Requests\RedirectRequest;
use Modules\RedirectManager\App\Models\Redirect;

class RedirectController extends Controller
{
    public function index(): View
    {
        $redirects = Redirect::query()->latest()->paginate(10);
        return view('redirect-manager::index', compact('redirects'));
    }

    public function create(): View
    {
        return view('redirect-manager::create');
    }

    public function store(RedirectRequest $request): RedirectResponse
    {
        Redirect::create($request->validated());
        return to_route(config('app.panel_prefix', 'panel') . '.redirects.index')
            ->with('success', __('entity_created', ['entity' => __('redirect')]));
    }

    public function edit(Redirect $redirect): View
    {
        return view('redirect-manager::edit', compact('redirect'));
    }

    public function update(RedirectRequest $request, Redirect $redirect): RedirectResponse
    {
        $redirect->update($request->validated());
        return to_route(config('app.panel_prefix', 'panel') . '.redirects.index')
            ->with('success', __('entity_edited', ['entity' => __('redirect')]));
    }

    public function destroy(Redirect $redirect): RedirectResponse
    {
        $redirect->delete();
        return back()->with('success', __('entity_deleted', ['entity' => __('redirect')]));
    }
}
