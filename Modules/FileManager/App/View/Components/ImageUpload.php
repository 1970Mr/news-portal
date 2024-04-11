<?php

namespace Modules\FileManager\App\View\Components;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\FileManager\App\Models\Image;

class ImageUpload extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public bool $hideBtn = false)
    {
        //
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return Gate::allows('store', Image::class) ?
            view('file-manager::components.image-upload') :
            '';
    }
}
