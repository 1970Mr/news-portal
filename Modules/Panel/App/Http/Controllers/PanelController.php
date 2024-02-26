<?php

namespace Modules\Panel\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class PanelController extends Controller
{
    public function __invoke(): View
    {
        return view('panel::index');
    }
}
