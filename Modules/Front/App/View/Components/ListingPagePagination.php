<?php

namespace Modules\Front\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ListingPagePagination extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $paginator) {}

    /**
     * Get the views/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('front::components.listing-page-pagination');
    }
}
