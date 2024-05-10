<?php

namespace Modules\Setting\App\Services;

use Modules\Setting\App\Http\Requests\SocialNetworkRequest;
use Modules\SocialNetwork\App\Traits\SocialNetwork;
use Modules\SocialNetwork\App\Models\SocialNetwork as SocialNetworkModel;

class SocialNetworkService
{
    use SocialNetwork;

    public const TAG = 'current-website';

    public const SOCIAL_NETWORKS = [
        'instagram' => 'https://instagram.com/{username}',
        'telegram' => 'https://t.me/{username}',
        'twitter' => 'https://twitter.com/{username}',
        'linkedin' => 'https://linkedin.com/in/{username}',
        'whatsapp' => 'https://wa.me/{phone_number}',
        'facebook' => 'https://facebook.com/{username}',
        'pinterest' => 'https://pinterest.com/{username}',
        'reddit' => 'https://reddit.com/user/{username}',
        'youtube' => 'https://youtube.com/{channel_id}',
        'github' => 'https://github.com/{username}',
        'rss' => 'https://example.com/rss',
    ];

    public function update(SocialNetworkRequest $request): void
    {
        $userSocialNetworks = $request->validated();
        foreach ($userSocialNetworks as $name => $url) {
            SocialNetworkModel::query()->updateOrCreate(
                [
                    'name' => $name,
                    'tag' => self::TAG,
                ],
                [ 'url' => $url ]
            );
        }
    }
}
