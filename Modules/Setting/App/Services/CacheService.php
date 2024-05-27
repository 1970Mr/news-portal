<?php

namespace Modules\Setting\App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public function clearAllCache(): void
    {
        Cache::flush();
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
    }

    public function clearApplicationCache(): void
    {
        Artisan::call('cache:clear');
    }

    public function clearViewCache(): void
    {
        Artisan::call('view:clear');
    }

    public function clearConfigCache(): void
    {
        Artisan::call('config:clear');
    }

    public function clearRouteCache(): void
    {
        Artisan::call('route:clear');
    }
}
