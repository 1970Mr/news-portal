<?php

namespace Modules\PageBuilder\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\PageBuilder\App\Http\Requests\PageBuilderRequest;
use Modules\PageBuilder\App\Models\Page;
use Modules\PageBuilder\App\Services\PageBuilderService;

class PageBuilderController extends Controller
{
    public function __construct(
        private readonly PageBuilderService $pageBuilderService
    )
    {
    }

    public function index(): View
    {
        $pages = Page::query()->latest()->paginate(10);
        return view('page-builder::index', compact('pages'));
    }

    public function create(): View
    {
        return view('page-builder::create');
    }

    public function store(PageBuilderRequest $request): RedirectResponse
    {
        $this->pageBuilderService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.pages.index')
            ->with('success', __('entity_created', ['entity' => __('page')]));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('pagebuilder::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pagebuilder::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
