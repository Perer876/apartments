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
            'required', 'mimes:png,jpg,jpeg'
        ]
    ];

    public function mount(Apartment $apartment)
    {
        $this->apartment = $apartment;
    }

    public function saves()
    {
        $this->validate();

        foreach ($this->images as $key => $file) {
            $image = new Image();

            $image->file_name = $file->getClientOriginalName();
            $image->file_extension = $file->extension();
            $image->file_path = $file->store('files', 'public');

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
