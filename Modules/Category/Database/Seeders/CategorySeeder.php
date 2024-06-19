<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\TransactionHelper;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed categories: ', static function () {
            $parentCategories = Category::factory(16)->create([
                'status' => true,
            ]);

            foreach ($parentCategories as $parentCategory) {
                if (fake()->boolean()) {
                    Category::factory(4)->withParent($parentCategory->id)->create();
                }
            }
        });
    }
}
