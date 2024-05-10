<?php

namespace Modules\Profile\App\Services;

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
    ];
}
