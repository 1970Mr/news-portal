<?php

namespace Modules\Share\App\View\Components;

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
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        $types = ['success', 'error', 'info'];
        return view('share::components.sweetalert', compact('types'));
    }
}
