<?php

namespace Modules\Article\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Article\App\Http\Requests\ArticleRequest;
use Modules\Article\App\Models\Article;
use Modules\FileManager\App\Services\ImageService;

class ArticleService
{
    public function store(ArticleRequest $request, ImageService $imageService): Model
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['featured_image_id'] = $imageService->store($request, 'featured_image')->id;
        $article = Article::query()->create($data);
        $article->tags()->sync($request->get('tag_ids', []));
        return $article;
    }

    public function destroy(Article $article, ImageService $imageService): bool|null
    {
        $imageService->destroyWithoutKeyConstraints($article->featured_image);
        return $article->delete();
    }
}
