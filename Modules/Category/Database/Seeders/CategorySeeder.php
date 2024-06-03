<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\FileManager\App\Helpers\ImageHelper;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed categories: ', static function() {
            $parentCategories = Category::factory(5)->create();

            foreach ($parentCategories as $parentCategory) {
                Category::factory(4)->withParent($parentCategory->id)->create();
            }
        });
    }
}
