<?php

namespace Modules\Common\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SweetAlert extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the views/contents that represent the component.
     */
    public function render(): View|string
    {
        $types = ['success', 'error', 'info'];

        return view('common::components.sweetalert', compact('types'));
    }
}
