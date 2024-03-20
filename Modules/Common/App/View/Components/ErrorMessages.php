<?php

namespace Modules\Common\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ErrorMessages extends Component
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
        return view('common::components.error-messages');
    }
}
