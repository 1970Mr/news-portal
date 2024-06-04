<?php

namespace Modules\Tag\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tag\App\Http\Requests\TagRequest;
use Modules\Tag\App\Models\Tag;

class TagService
{
    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $articles = $this->search($searchText);
        } else {
            $articles = Tag::with('hotness')->latest()->paginate(10);
        }
        return $articles;
    }

    public function store(TagRequest $request): Tag
    {
        $tag = Tag::create($request->validated());
        $this->setHotness($tag, $request);
        return $tag;
    }

    public function update(TagRequest $request, Tag $tag): Tag
    {
        $tag->update($request->validated());
        $this->setHotness($tag, $request);
        return $tag;
    }

    public function destroy(Tag $tag): void
    {
        $tag->hotness()->delete();
        $tag->delete();
    }

    private function setHotness(Tag $tag, TagRequest $request): void
    {
        if (Auth::user()->can(config('permissions_list.TAG_HOTNESS', false))) {
            $tag->hotness()->updateOrCreate([], ['is_hot' => $request->hotness]);
        }
    }

    private function search(mixed $searchText): Paginator
    {
        return Tag::search($searchText)->query(static function (Builder $query) {
            $query->with('hotness');
        })->latest()->paginate(10);
    }
}
