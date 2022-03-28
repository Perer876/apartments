<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Modal extends Component
{
    public $name;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.index');
    }
}
