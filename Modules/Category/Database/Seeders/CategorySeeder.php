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
                $defaultImage = ImageHelper::createDefaultImage();
                $parentCategory->image()->save($defaultImage);
                $childCategories = Category::factory(3)->withParent($parentCategory->id)->create();

                foreach ($childCategories as $childCategory) {
                    $defaultImage = ImageHelper::createDefaultImage();
                    $childCategory->image()->save($defaultImage);
                }
            }
        });
    }
}
