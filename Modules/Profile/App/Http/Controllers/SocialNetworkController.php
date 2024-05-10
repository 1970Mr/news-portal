<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\SocialNetworkRequest;
use Modules\Profile\App\Services\SocialNetworkService;

class SocialNetworkController extends Controller
{
    public function edit(): View
    {
        $userSocialNetworks = collect();
        foreach (auth()->user()->socialNetworks as $socialNetwork) {
            $userSocialNetworks[$socialNetwork->name] = $socialNetwork->url;
        }
        $socialNetworksList = SocialNetworkService::SocialNetworks;
        return view('profile::social-networks-address', compact(['userSocialNetworks', 'socialNetworksList']));
    }

    public function update(SocialNetworkRequest $request): RedirectResponse
    {
        $userSocialNetworks = $request->validated();
        foreach ($userSocialNetworks as $name => $url) {
            auth()->user()->socialNetworks()->updateOrCreate(
                ['name' => $name],
                ['url' => $url]
            );
        }
        return back()->with(['success' => 'آدرس‌های شبکه‌های اجتماعی با موفقیت ثبت شدند.']);
    }
}
