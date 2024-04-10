<?php

namespace Modules\FileManager\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ImageSelector extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $images)
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('file-manager::components.image-selector');
    }
}
