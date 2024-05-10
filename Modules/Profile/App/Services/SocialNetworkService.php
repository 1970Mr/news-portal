<?php

namespace Modules\Profile\App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Profile\App\Http\Requests\SocialNetworkRequest;

class SocialNetworkService
{
    public const SocialNetworks = [
        'instagram' => 'https://instagram.com/{username}',
        'telegram' => 'https://t.me/{username}',
        'twitter' => 'https://twitter.com/{username}',
        'linkedin' => 'https://linkedin.com/in/{username}',
        'whatsapp' => 'https://wa.me/{phone_number}',
        'facebook' => 'https://facebook.com/{username}',
        'pinterest' => 'https://pinterest.com/{username}',
        'youtube' => 'https://youtube.com/{channel_id}',
        'github' => 'https://github.com/{username}',
    ];

    public function update(SocialNetworkRequest $request): void
    {
        $userSocialNetworks = $request->validated();
        $user = Auth::user();
        foreach ($userSocialNetworks as $name => $url) {
            $user->socialNetworks()->updateOrCreate(
                ['name' => $name],
                ['url' => $url]
            );
        }
    }

    public function getUserSocialNetworks(): Collection
    {
        $userSocialNetworks = collect();
        foreach (auth()->user()->socialNetworks as $socialNetwork) {
            $userSocialNetworks[$socialNetwork->name] = $socialNetwork->url;
        }
        return $userSocialNetworks;
    }
}
