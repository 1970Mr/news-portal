<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\App\Models\Category;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Menu\App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed menus: ', static function () {
            Menu::factory(10)->create();
        });
    }
}
