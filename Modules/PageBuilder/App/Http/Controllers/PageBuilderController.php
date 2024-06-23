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

    public function edit(Page $page): View
    {
        return view('page-builder::edit', compact('page'));
    }

    public function update(PageBuilderRequest $request, Page $page): RedirectResponse
    {
        $this->pageBuilderService->update($request, $page);
        return to_route(config('app.panel_prefix', 'panel') . '.pages.index')
            ->with('success', __('entity_edited', ['entity' => __('page')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
