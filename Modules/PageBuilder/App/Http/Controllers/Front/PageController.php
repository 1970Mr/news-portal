<?php

namespace Modules\PageBuilder\App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\PageBuilder\App\Models\Page;

class PageController extends Controller
{
    public function __invoke(Page $page)
    {
//        $this->seoService->setPageSEO($article);
        abort_if(!$page->isActive(), 404);
        return view('front::page.show', compact(['page']));
    }
}
