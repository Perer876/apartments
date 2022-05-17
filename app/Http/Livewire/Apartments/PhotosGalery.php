<?php

namespace App\Http\Livewire\Apartments;

use Livewire\Component;
use App\Models\Apartment;
use App\Models\Image;

class PhotosGalery extends Component
{
    public $apartment;

    protected $listeners = ['imagesValidated' => 'render'];

    public function mount(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    public function deletePhoto($image)
    {
        Image::find($image)->delete();
        $this->apartment->refresh();
    }

    public function render()
    {
        return view('livewire.apartments.photos-galery');
    }
}
