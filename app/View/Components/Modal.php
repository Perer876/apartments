<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Modal extends Component
{
    public $uuid;
    public $type;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $title)
    {
        $this->uuid = (string) Str::uuid();
        $this->type = $type;
        $this->title = $title;
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
