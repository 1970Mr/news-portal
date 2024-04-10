<?php

namespace Modules\FileManager\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\FileManager\App\Models\Image;

class ImageSelector extends Component
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
        $filters = Image::filters();
        return view('file-manager::components.image-selector', compact('filters'));
    }
}
