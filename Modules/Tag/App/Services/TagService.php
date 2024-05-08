<?php

namespace Modules\Tag\App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Modules\Tag\App\Http\Requests\TagRequest;
use Modules\Tag\App\Models\Tag;

class TagService
{
    public function store(TagRequest $request): Tag
    {
        $tag = Tag::create($request->validated());
        $this->setHotness($tag, $request, 'create');
        return $tag;
    }

    public function update(TagRequest $request, Tag $tag): Tag
    {
        $tag->update($request->validated());
        $this->setHotness($tag, $request, 'update');
        return $tag;
    }

    public function destroy(Tag $tag): void
    {
        $tag->hotness()->delete();
        $tag->delete();
    }

    private function setHotness(Tag $tag, TagRequest $request, string $method): void
    {
        if (Auth::user()->can(config('permissions_list.TAG_HOTNESS', false))) {
            $tag->hotness()->{$method}(['is_hot' => $request->hotness]);
        }
    }
}
