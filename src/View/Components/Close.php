<?php

namespace Shield\View\Components;

use Illuminate\View\Component;

class Close extends Component
{
    public $id;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('shield::components.close');
    }
}
