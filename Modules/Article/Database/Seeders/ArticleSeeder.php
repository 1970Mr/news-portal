<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Article\App\Models\Article;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\FileManager\App\Helpers\ImageHelper;
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

            $articles = Article::factory(20)->create();
            foreach ($articles as $article) {
                $defaultImage = ImageHelper::createDefaultImage();
                $article->image()->save($defaultImage);
                if (random_int(0, 1)) {
                    $article->hotness()->create(['is_hot' => true]);
                }
            }
        });
    }
}
