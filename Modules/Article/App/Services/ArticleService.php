<?php

namespace Modules\Article\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Article\App\Http\Requests\ArticleRequest;
use Modules\Article\App\Models\Article;
use Modules\FileManager\App\Services\ImageService;

class ArticleService
{
    public function __construct(
        private readonly ImageService $imageService
    ) {}
    public function store(ArticleRequest $request): Model
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $article = Article::query()->create($data);
        $article->tags()->sync($request->get('tag_ids', []));
        $image = $this->imageService->store($request, altText: $article->title);
        $article->image()->save($image);
        $article->hotness()->create(['is_hot' => $request->hotness]);
        return $article;
    }

    public function update(ArticleRequest $request, Article $article): bool
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $result = $article->update($data);
        $this->imageService->uploadImageDuringUpdate($request, $article, $article->title);
        $article->tags()->sync($request->get('tag_ids', []));
        $article->hotness()->update(['is_hot' => $request->hotness]);
        return $result;
    }

    public function destroy(Article $article): bool|null
    {
        $this->imageService->destroyWithoutKeyConstraints($article->image);
        $article->tags()->detach();
        $article->hotness()->delete();
        return $article->delete();
    }
}
