<?php

namespace App\Http\Livewire\Apartments;

use Livewire\Component;
use App\Models\Apartment;

class PhotosGalery extends Component
{
    public $apartment;

    protected $listeners = ['imagesValidated' => 'render'];

    public function mount(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    public function render()
    {
        return view('livewire.apartments.photos-galery', ['apartment' => $this->apartment]);
    }
}
