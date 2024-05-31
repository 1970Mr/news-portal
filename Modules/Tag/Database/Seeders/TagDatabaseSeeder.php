<?php

namespace Modules\Tag\Database\Seeders;

use Illuminate\Database\Seeder;

class TagDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TagSeeder::class
        ]);
    }
}
