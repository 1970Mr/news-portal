<?php

namespace Modules\PageBuilder\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\PageBuilder\App\Models\Page;
use Modules\SEOManager\App\Services\Front\SEOService;

class PageController extends Controller
{
    public function __construct(private readonly SEOService $seoService) {}

    public function __invoke(Page $page)
    {
        $this->seoService->setPageSEO($page);
        abort_if(! $page->isActive(), 404);

        return view('front::page.show', compact(['page']));
    }
}
