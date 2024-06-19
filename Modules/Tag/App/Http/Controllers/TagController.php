<?php

namespace Modules\Tag\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Tag\App\Http\Requests\TagRequest;
use Modules\Tag\App\Models\Tag;
use Modules\Tag\App\Services\TagService;

class TagController extends Controller
{
    public function __construct(private readonly TagService $tagService)
    {
        $this->middleware('can:' . config('permissions_list.TAG_INDEX', false))->only('index');
        $this->middleware('can:' . config('permissions_list.TAG_STORE', false))->only('store');
        $this->middleware('can:' . config('permissions_list.TAG_UPDATE', false))->only('update');
        $this->middleware('can:' . config('permissions_list.TAG_DESTROY', false))->only('destroy');
    }

    public function index(Request $request): View
    {
        $tags = $this->tagService->index($request);
        return view('tag::index', compact('tags'));
    }

    public function create(): View
    {
        $tags = Tag::latest()->get();
        return view('tag::create', compact('tags'));
    }

    public function store(TagRequest $request): RedirectResponse
    {
        $this->tagService->store($request);
        return to_route(config('app.panel_prefix', 'panel') . '.tags.index')->with('success', __('entity_created', ['entity' => __('tag')]));
    }

    public function edit(Tag $tag): View
    {
        $tags = Tag::with('hotness')->latest()->get();
        return view('tag::edit', compact('tag', 'tags'));
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $this->tagService->update($request, $tag);
        return to_route(config('app.panel_prefix', 'panel') . '.tags.index')->with('success', __('entity_edited', ['entity' => __('tag')]));
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $this->tagService->destroy($tag);
        return back()->with('success', __('entity_deleted', ['entity' => __('tag')]));
    }

    public function SEOSettings(Tag $tag): view
    {
        $nextUrl = config('app.panel_prefix', 'panel') . '.tags.index';
        $title = $tag->name;
        $pageTitle = __('tag') . ' ' . $title;
        // Optional placeholders
        $canonicalUrl = route('tags.show', $tag->slug);
        return view('seo-manager::seo-settings', compact(['nextUrl', 'title', 'canonicalUrl', 'pageTitle']) + ['model' => $tag]);
    }
}
