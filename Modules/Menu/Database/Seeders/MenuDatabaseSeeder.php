<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            MenuSeeder::class,
        ]);
    }
}
