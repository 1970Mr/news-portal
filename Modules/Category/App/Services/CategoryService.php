<?php

namespace Modules\Category\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\App\Http\Requests\CategoryRequest;
use Modules\Category\App\Models\Category;
use Modules\FileManager\App\Services\ImageService;

class CategoryService
{
    public function __construct(private readonly ImageService $imageService) {}

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
}
