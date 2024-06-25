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
        $this->middleware('can:' . config('permissions_list.PAGE_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.PAGE_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.PAGE_UPDATE', false))->only('update');
        $this->middleware('can:' . config('permissions_list.PAGE_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $pages = $this->pageBuilderService->index($request);
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

    public function destroy(Page $page): RedirectResponse
    {
        $this->pageBuilderService->destroy($page);
        return back()
            ->with('success', __('entity_deleted', ['entity' => __('page')]));
    }

    public function SEOSettings(Page $page): view
    {
        $nextUrl = config('app.panel_prefix', 'panel') . '.pages.index';
        $title = $page->title;
        $pageTitle = __('page') . ' ' . $title;
        // Optional placeholder
        $canonicalUrl = $page->url();
        return view('seo-manager::seo-settings', compact(['nextUrl', 'title', 'canonicalUrl', 'pageTitle']) + ['model' => $page]);
    }
}
