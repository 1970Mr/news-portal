<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Setting\App\Models\SiteDetail;

class SiteDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed site details: ', static function () {
            $siteDetailData = SiteDetail::factory()->make()->toArray();
            $siteDetail = SiteDetail::firstOrNew();
            $siteDetail->fill($siteDetailData)->save();
        });
    }
}
