<?php

namespace Modules\Common\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Breadcrumbs extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $noprefix = false,
    ) {}

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('common::components.breadcrumbs');
    }
}
