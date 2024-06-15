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
            if (Category::active()->count() === 0) {
                Category::factory(5)->create();
            }

            Menu::factory(10)->create()->each(function (Menu $menu) {
                $data = [];
                if ($menu->type === Menu::SUBMENU_TYPE ) {
                    if (Menu::mainMenus()->count() > 0) {
                        $data['parent_id'] = Menu::mainMenus()->inRandomOrder()->first()->id;
                    }
                    else {
                        $data['type'] = Menu::MAIN_TYPE;
                    }
                } elseif ($menu->type === Menu::CATEGORY_TYPE || $menu->type === Menu::PARENT_CATEGORY_TYPE) {
                    $data['name'] = null;
                    $data['url'] = null;
                    $data['category_id'] = Category::query()->active()->inRandomOrder()->first()->id;
                }
                $menu->update($data);
            });
        });
    }
}
