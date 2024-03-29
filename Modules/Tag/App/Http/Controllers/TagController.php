<?php

namespace Modules\Tag\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Tag\App\Http\Requests\TagRequest;
use Modules\Tag\App\Models\Tag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:' . config('permissions_list.TAG_INDEX'))->only('index');
        $this->middleware('can:' . config('permissions_list.TAG_STORE'))->only('store');
        $this->middleware('can:' . config('permissions_list.TAG_UPDATE'))->only('update');
        $this->middleware('can:' . config('permissions_list.TAG_DESTROY'))->only('destroy');
    }

    public function index(): View
    {
        $tags = Tag::latest()->paginate(10);
        return view('tag::index', compact('tags'));
    }

    public function create(): View
    {
        $tags = Tag::latest()->get();
        return view('tag::create', compact('tags'));
    }

    public function store(TagRequest $request): RedirectResponse
    {
        Tag::create($request->validated());
        return to_route('tag.index')->with('success', __('entity_created', ['entity' => __('tag')]));
    }

    public function edit(Tag $tag): View
    {
        $tags = Tag::latest()->get();
        return view('tag::edit', compact('tag', 'tags'));
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($request->validated());
        return to_route('tag.index')->with('success', __('entity_edited', ['entity' => __('tag'), 'name' => $request->name]));
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return to_route('tag.index')->with('success', __('entity_deleted', ['entity' => __('tag')]));
    }
}
