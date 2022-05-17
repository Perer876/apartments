<?php

namespace App\Http\Livewire\Apartments;

use Livewire\Component;
use App\Models\Apartment;
use App\Models\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PhotosGalery extends Component
{
    use AuthorizesRequests;

    public $apartment;

    protected $listeners = ['imagesValidated' => 'render'];

    public function mount(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    public function deletePhoto($image)
    {
        $this->authorize('update', $this->apartment);
        Image::find($image)->delete();
        $this->apartment->refresh();
    }

    public function render()
    {
        return view('livewire.apartments.photos-galery');
    }
}
