<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\FileManager\App\Helpers\ImageHelper;
use Modules\Tag\App\Models\Tag;
use Modules\User\App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed articles: ', static function () {
            if (Category::count() === 0) {
                Category::factory(5)->create();
            }

            if (User::count() === 0) {
                User::factory(5)->create();
            }

            if (Tag::count() === 0) {
                Tag::factory(5)->create();
            }

            $users = User::all();
            $tags = Tag::all();
            Category::query()->whereDoesntHave('articles')->active()->limit(30)->each(function ($category) use ($users, $tags) {
//                $articlesCount = random_int(1, 10);
                Article::factory(10)->create([
                    'category_id' => $category->id,
                    'user_id' => $users->random()->id,
                ])->each(function ($article) use ($tags) {
                    if (random_int(0, 5) === 5) {
                        $article->hotness()->create(['is_hot' => true]);
                    }

                    $randomTags = $tags->random(random_int(1, 8))->pluck('id')->toArray();
                    $article->tags()->sync($randomTags);
                });
            });
        });
    }
}
