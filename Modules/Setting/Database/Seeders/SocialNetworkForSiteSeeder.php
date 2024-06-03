<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\App\Helpers\TransactionHelper;
use Modules\Setting\App\Services\SocialNetworkService;
use Modules\SocialNetwork\App\Models\SocialNetwork;

class SocialNetworkForSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialNetworks = SocialNetworkService::SOCIAL_NETWORKS;
        $tag = SocialNetworkService::TAG;
        TransactionHelper::beginTransaction('Failed to seed social networks for current site: ', function () use ($socialNetworks, $tag) {
            foreach ($socialNetworks as $name => $urlTemplate) {
                SocialNetwork::factory()->withDetails($name, $urlTemplate, $tag)->make();
            }
        });
    }
}
