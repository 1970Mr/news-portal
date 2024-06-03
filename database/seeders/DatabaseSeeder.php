<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Article\Database\Seeders\ArticleSeeder;
use Modules\Category\Database\Seeders\CategorySeeder;
use Modules\ContactUs\Database\Seeders\ContactInfoSeeder;
use Modules\Setting\Database\Seeders\AboutUsSeeder;
use Modules\Setting\Database\Seeders\SiteDetailSeeder;
use Modules\Setting\Database\Seeders\SocialNetworkForSiteSeeder;
use Modules\Tag\Database\Seeders\TagSeeder;
use Modules\User\Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ArticleSeeder::class,
            ContactInfoSeeder::class,
            SiteDetailSeeder::class,
            AboutUsSeeder::class,
            SocialNetworkForSiteSeeder::class,
        ]);
    }
}
