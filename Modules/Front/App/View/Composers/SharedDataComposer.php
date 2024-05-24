<?php

namespace Modules\Front\App\View\Composers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Modules\AdManager\App\Models\Ad;
use Modules\Article\App\Services\Front\ArticleService;
use Modules\ContactUs\App\Models\ContactInfo;
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

        $contactInfo = Cache::remember('contact_info', 60 * 60, static function () {
            return ContactInfo::query()->first(['email', 'phone']);
        });

        $ads = Cache::remember('ads', 60 * 60, static function () {
            return [
                'header' => Ad::active()->bySection(Ad::HEADER)->first(),
                'first_sidebar' => Ad::active()->bySection(Ad::FIRST_SIDEBAR)->first(),
                'second_sidebar' => Ad::active()->bySection(Ad::SECOND_SIDEBAR)->first(),
                'third_sidebar' => Ad::active()->bySection(Ad::THIRD_SIDEBAR)->limit(5)->get(),
                'first_content' => Ad::active()->bySection(Ad::FIRST_CONTENT)->first(),
                'second_content' => Ad::active()->bySection(Ad::SECOND_CONTENT)->first(),
                'third_content' => Ad::active()->bySection(Ad::THIRD_CONTENT)->first(),
                'fourth_content' => Ad::active()->bySection(Ad::FOURTH_CONTENT)->first(),
            ];
        });

        $viewData = $this->articleService->composeViewData();
        $viewData['social_networks'] = $socialNetworks;
        $viewData['site_details'] = $siteDetails;
        $viewData['contact_info'] = $contactInfo;
        $viewData['ads'] = $ads;
        $view->with($viewData);
    }
}
