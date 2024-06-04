<?php

namespace Modules\Category\App\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Category\App\Http\Requests\CategoryRequest;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Services\ImageService;

class CategoryService
{
    public function __construct(private readonly ImageService $imageService) {}

    public function index(Request $request): Paginator
    {
        $searchText = $request->get('query');
        if ($searchText) {
            $categories = $this->search($searchText);
        } else {
            $categories = Category::with('image')->latest('updated_at')->paginate(10);
        }
        return $categories;
    }

    public function store(CategoryRequest $request): Model
    {
        $category = Category::query()->create($request->validated());
        $image = $this->imageService->store($request, altText: $category->name);
        $category->image()->save($image);
        return $category;
    }

    public function update(CategoryRequest $request, Category $category): bool
    {
        $result = $category->update($request->validated());
        $this->imageService->uploadImageDuringUpdate($request, $category);
        return $result;
    }

    private function search(mixed $searchText): Paginator
    {
        return Category::search($searchText)->query(static function (Builder $query) use ($searchText) {
            // Search in parent categories
            $query->orWhereHas('category', function ($q) use ($searchText) {
                $q->where('name', 'like', "%{$searchText}%");
            });
        })->latest('updated_at')->paginate(10);
    }
}
