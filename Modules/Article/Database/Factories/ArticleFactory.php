<?php

namespace Modules\Article\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\FactoryHelper;
use Modules\User\App\Models\User;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Article\App\Models\Article::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        [
            'title',
            'slug',
            'description',
            'keywords',
            'body',
            'published_at',
            'editor_choice',
            'status',
            'category_id',
            'user_id',
        ];

        $title = fake()->unique()->word;
        $uniqueTitle = FactoryHelper::uniqueValue(Article::class, 'title', $title);

        return [
            'title' => $uniqueTitle,
            'slug' => Str::slug($uniqueTitle),
            'description' => fake()->paragraph,
            'keywords' => implode(', ', fake()->words(5)),
            'body' => fake()->paragraphs(3, true),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'editor_choice' => fake()->boolean,
            'status' => fake()->boolean,
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
