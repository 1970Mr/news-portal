<?php

namespace Modules\SEOManager\App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SEOSettingsButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route
    )
    {
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('seo-manager::components.seo-settings-button');
    }
}
