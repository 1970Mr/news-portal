<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Article\Database\Seeders\ArticleSeeder;
use Modules\Category\Database\Seeders\CategorySeeder;
use Modules\ContactUs\Database\Seeders\ContactInfoSeeder;
use Modules\MenuBuilder\Database\Seeders\MenuSeeder;
use Modules\Role\Database\Seeders\PermissionSeeder;
use Modules\Role\Database\Seeders\RoleSeeder;
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
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ArticleSeeder::class,
            MenuSeeder::class,
            ContactInfoSeeder::class,
            SiteDetailSeeder::class,
            AboutUsSeeder::class,
            SocialNetworkForSiteSeeder::class,
        ]);
    }
}
