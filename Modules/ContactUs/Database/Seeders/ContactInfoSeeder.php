<?php

namespace Modules\ContactUs\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\ContactUs\App\Models\ContactInfo;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionHelper::beginTransaction('Failed to seed contact info: ', static function () {
            $contactInfoData = ContactInfo::factory()->make()->toArray();
            $contactInfo = ContactInfo::firstOrNew();
            $contactInfo->fill($contactInfoData)->save();
        });
    }
}
