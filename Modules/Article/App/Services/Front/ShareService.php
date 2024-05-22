<?php

namespace Modules\Article\App\Services\Front;

use Jorenvh\Share\ShareFacade;

class ShareService
{
    public function generateSharedLinks(string $url, string $title): array
    {
        return ShareFacade::page($url, $title)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->pinterest()
            ->getRawLinks();
    }
}
