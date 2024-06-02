<?php

namespace Modules\Category\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\FactoryHelper;
use Modules\FileManager\App\Helpers\ImageHelper;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->word;
        $uniqueName = FactoryHelper::uniqueValue(Category::class, 'name', $name);

        return [
            'name' => ucfirst($uniqueName),
            'slug' => Str::slug($uniqueName),
            'description' => fake()->sentence,
            'status' => fake()->boolean,
            'parent_id' => null,
        ];
    }

    public function withParent(int $parentId): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentId,
        ]);
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Category $category) {
            $defaultImage = ImageHelper::createDefaultImage();
            $category->image()->save($defaultImage);
        });
    }
}
