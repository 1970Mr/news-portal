<?php

namespace Modules\Category\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Http\Requests\CategoryRequest;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Services\Image\ImageService;

class CategoryService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $categories = $this->search($searchText);
        } else {
            $categories = Category::with('image')->latest()->paginate(10);
        }

        return $categories;
    }

    private function search(mixed $searchText): Paginator
    {
        return Category::search($searchText)->query(static function (Builder $query) use ($searchText) {
            $query->with('image');
            // Search in parent categories
            $query->orWhereHas('category', function ($q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%");
            });
        })->latest()->paginate(10);
    }

    public function store(CategoryRequest $request): Model
    {
        $category = Category::query()->create($request->validated());
        $image = $this->imageService->store($request, altText: $category->name);
        $category->image()->save($image);

        return $category;
    }

    public function destroy(Category $category): void
    {
        $this->reassignArticles($category);
        $this->imageService->destroyWithoutKeyConstraints($category->image);
        $category->delete();
    }

    private function reassignArticles(Category $category): void
    {
        if ($category->articles && $category->articles->count() > 0) {
            $firstCategory = Category::query()->firstOrFail();
            $category->articles->each(function (Article $article) use ($firstCategory) {
                $article->update(['category_id' => $firstCategory->id]);
            });
        }
    }

    public function update(CategoryRequest $request, Category $category): bool
    {
        $result = $category->update($request->validated());
        $this->imageService->uploadImageDuringUpdate($request, $category);

        return $result;
    }
}
