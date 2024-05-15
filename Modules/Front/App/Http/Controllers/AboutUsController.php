<?php

namespace Modules\Front\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Setting\App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function __invoke(): View
    {
        $about = AboutUs::first();
        return view('front::about-us.index', compact('about'));
    }
}
