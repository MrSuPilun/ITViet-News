<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;

class FeaturePostComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $feature;

    public function __construct($feature)
    {
        $this->feature = $feature;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.feature-post-component');
    }
}
