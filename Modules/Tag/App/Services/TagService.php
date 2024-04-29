<?php

namespace Modules\Tag\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Tag\App\Http\Requests\TagRequest;
use Modules\Tag\App\Models\Tag;

class TagService
{
    public function store(TagRequest $request): Model
    {
        $tag = Tag::create($request->validated());
        $tag->hotness()->create(['is_hot' => $request->hotness]);
        return $tag;
    }

    public function update(TagRequest $request, Tag $tag): void
    {
        $tag->update($request->validated());
        $tag->hotness()->update(['is_hot' => $request->hotness]);
    }

    public function destroy(Tag $tag): void
    {
        $tag->hotness()->delete();
        $tag->delete();
    }
}
