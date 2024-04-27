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
        $image = $this->imageService->store($request, 'featured_image');
        $article = Article::query()->create($data);
        $article->tags()->sync($request->get('tag_ids', []));
        $article->image()->save($image);
        return $article;
    }

    public function update(ArticleRequest $request, Article $article): bool
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data = $this->uploadImageDuringUpdate($request, $article, $data);
        $result = $article->update($data);
        $article->tags()->sync($request->get('tag_ids', []));
        return $result;
    }

    public function destroy(Article $article): bool|null
    {
        $this->imageService->destroyWithoutKeyConstraints($article->image);
        $article->tags()->detach();
        return $article->delete();
    }

    private function uploadImageDuringUpdate(ArticleRequest $request, Article $article, array $data): array
    {
        if ($request->hasFile('featured_image')) {
            $data['featured_image_id'] = $this->imageService->store($request, 'featured_image')->id;
            $this->imageService->destroyWithoutKeyConstraints($article->featured_image);
        }
        return $data;
    }
}
