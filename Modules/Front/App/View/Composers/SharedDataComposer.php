<?php

namespace Modules\Front\App\View\Composers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Modules\Article\App\Services\Front\ArticleService;
use Modules\Setting\App\Services\SocialNetworkService;

class SharedDataComposer
{
    public function __construct(private readonly ArticleService $articleService, private readonly SocialNetworkService $socialNetworkService) {}

    public function compose(View $view): void
    {
        $socialNetworks = Cache::remember('social_networks', 60 * 60, function () {
            return $this->socialNetworkService->getSocialNetworksWithTag(SocialNetworkService::TAG);
        });

        $viewData = $this->articleService->composeViewData();
        $viewData['social_networks'] = $socialNetworks;
        $view->with($viewData);
    }
}
