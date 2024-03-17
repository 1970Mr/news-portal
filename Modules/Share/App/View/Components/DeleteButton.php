<?php

namespace Modules\Share\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DeleteButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route
    ) {}

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('share::components.delete-button');
    }
}
