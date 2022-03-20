<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Modal extends Component
{
    public $uuid;
    public $type;
    public $title;
    public $close;
    public $accept;
    public $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $title, $close, $accept, $href)
    {
        $this->uuid = (string) Str::uuid();
        $this->type = $type;
        $this->title = $title;
        $this->close = $close;
        $this->accept = $accept;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
