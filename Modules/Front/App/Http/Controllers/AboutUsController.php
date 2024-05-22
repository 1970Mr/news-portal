<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Common\App\Services\SEOService;
use Modules\Setting\App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function __construct(private readonly SEOService $SEOService) {}

    public function __invoke(): View
    {
        $this->SEOService->setAboutUsPageSEO();
        $about = AboutUs::first();
        return view('front::about-us.index', compact('about'));
    }
}
