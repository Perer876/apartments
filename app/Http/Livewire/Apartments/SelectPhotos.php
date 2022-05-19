<?php

namespace App\Http\Livewire\Apartments;

use App\Models\Apartment;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class SelectPhotos extends Component
{
    use WithFileUploads;

    public $images = [];
    public $apartment;

    protected $listeners = ['saves' => 'saves'];

    protected $rules = [
        'images.*' => [
            'required', 'mimes:png,jpg,jpeg,webp'
        ]
    ];

    public function mount(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    public function saves()
    {
        $this->validate();

        foreach ($this->images as $file)
        {
            $image = Image::fromFile($file, 'files/images', 'public');
            $this->apartment->images()->save($image);
        }
        
        $this->emit('imagesValidated');
    }

    public function updated()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.apartments.select-photos');
    }
}
