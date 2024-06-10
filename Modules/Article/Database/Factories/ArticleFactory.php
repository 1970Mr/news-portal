<?php

namespace Modules\Article\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\FactoryHelper;
use Modules\FileManager\App\Helpers\ImageHelper;
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
        $title = fake()->word;
        $uniqueTitle = FactoryHelper::uniqueValue(Article::class, 'title', $title);

        return [
            'title' => $uniqueTitle,
            'slug' => Str::slug($uniqueTitle),
            'body' => fake()->paragraphs(3, true),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now')->getTimestamp(),
            'editor_choice' => fake()->boolean,
            'status' => fake()->boolean,
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }

    public function configure(): Factory
    {
        return $this->afterCreating(function (Article $article) {
            $defaultImage = ImageHelper::createDefaultImage();
            $article->image()->save($defaultImage);
        });
    }
}
