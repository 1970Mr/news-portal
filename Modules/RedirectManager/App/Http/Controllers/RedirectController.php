<?php

namespace Modules\RedirectManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\RedirectManager\App\Http\Requests\RedirectRequest;
use Modules\RedirectManager\App\Models\Redirect;
use Modules\RedirectManager\App\Services\RedirectService;

class RedirectController extends Controller
{
    public function __construct(private readonly RedirectService $redirectService)
    {
        $this->middleware('can:'.config('permissions_list.REDIRECT_INDEX', false))->only('index');
        $this->middleware('can:'.config('permissions_list.REDIRECT_STORE', false))->only('store');
        $this->middleware('can:'.config('permissions_list.REDIRECT_UPDATE', false))->only('update');
        $this->middleware('can:'.config('permissions_list.REDIRECT_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $redirects = $this->redirectService->index($request);

        return view('redirect-manager::index', compact('redirects'));
    }

    public function store(RedirectRequest $request): RedirectResponse
    {
        Redirect::create($request->validated());

        return to_route(config('app.panel_prefix', 'panel').'.redirects.index')
            ->with('success', __('entity_created', ['entity' => __('redirect')]));
    }

    public function create(): View
    {
        return view('redirect-manager::create');
    }

    public function edit(Redirect $redirect): View
    {
        return view('redirect-manager::edit', compact('redirect'));
    }

    public function update(RedirectRequest $request, Redirect $redirect): RedirectResponse
    {
        $redirect->update($request->validated());

        return to_route(config('app.panel_prefix', 'panel').'.redirects.index')
            ->with('success', __('entity_edited', ['entity' => __('redirect')]));
    }

    public function destroy(Redirect $redirect): RedirectResponse
    {
        $redirect->delete();

        return back()->with('success', __('entity_deleted', ['entity' => __('redirect')]));
    }
}
