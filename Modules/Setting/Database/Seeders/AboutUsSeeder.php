<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Setting\App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed about us: ', static function () {
            $aboutUsData = AboutUs::factory()->make()->toArray();
            $aboutUs = AboutUs::firstOrNew();
            $aboutUs->fill($aboutUsData)->save();
        });
    }
}
