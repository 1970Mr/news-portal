<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\SocialNetworkRequest;
use Modules\Profile\App\Services\SocialNetworkService;

class SocialNetworkController extends Controller
{
    public function __construct(private readonly SocialNetworkService $socialNetworkService)
    {
        $this->middleware('can:' . config('permissions_list.PROFILE_SOCIAL_NETWORKS', false));
    }

    public function edit(): View
    {
        $userSocialNetworks = $this->socialNetworkService->getUserSocialNetworks();
        $socialNetworksList = SocialNetworkService::SOCIAL_NETWORKS;
        return view('profile::social-networks-address', compact(['userSocialNetworks', 'socialNetworksList']));
    }

    public function update(SocialNetworkRequest $request): RedirectResponse
    {
        $this->socialNetworkService->update($request);
        return back()->with(['success' => __('Social network addresses have been registered successfully.')]);
    }
}
