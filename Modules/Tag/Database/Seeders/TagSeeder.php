<?php

namespace Modules\Tag\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Tag\App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed tags: ', static function() {
            $tags = Tag::factory(10)->create();
            foreach ($tags as $tag) {
                if (random_int(0, 1)) {
                    $tag->hotness()->create(['is_hot' => true]);
                }
            }
        });
    }
}
