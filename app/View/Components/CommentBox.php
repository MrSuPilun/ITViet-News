<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CommentBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $level;
    public $item;

    public function __construct($item, $level)
    {
        $this->item = $item;
        $this->level = $level + 1;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment-box');
    }
}
