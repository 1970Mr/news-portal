<?php

namespace Modules\Tag\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Common\App\Helpers\FactoryHelper;
use Modules\Tag\App\Models\Tag;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Tag\App\Models\Tag::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = fake()->unique()->word;
        $uniqueName = FactoryHelper::uniqueValue(Tag::class, 'name', $name);

        return [
            'name' => ucfirst($uniqueName),
            'slug' => Str::slug($uniqueName),
            'description' => fake()->sentence,
            'status' => fake()->boolean,
        ];
    }
}
