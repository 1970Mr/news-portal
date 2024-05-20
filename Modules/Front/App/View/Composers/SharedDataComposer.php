<?php

namespace Modules\Front\App\View\Composers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Modules\Article\App\Services\Front\ArticleService;
use Modules\Setting\App\Models\SiteDetail;
use Modules\Setting\App\Services\SocialNetworkService;

class SharedDataComposer
{
    public function __construct(
        private readonly ArticleService $articleService,
        private readonly SocialNetworkService $socialNetworkService) {}

    public function compose(View $view): void
    {
        $socialNetworks = Cache::remember('social_networks', 60 * 60, function () {
            return $this->socialNetworkService->getSocialNetworksWithTag(SocialNetworkService::TAG);
        });

        $siteDetails = Cache::remember('site_details', 60 * 60, static function () {
            return SiteDetail::with('footerLogo', 'headerLogo')->first();
        });

        $viewData = $this->articleService->composeViewData();
        $viewData['social_networks'] = $socialNetworks;
        $viewData['site_details'] = $siteDetails;
        $view->with($viewData);
    }
}
