<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Apartment;
use App\Traits\Views\WithSorting;
use App\Traits\Views\WithSearch;
use Livewire\WithPagination;

class SelectApartment extends Component
{
    use WithSorting;
    use WithSearch;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $defaultValue = [
        'sortBy' => 'number',
    ];

    protected $validSortByValues = [
        'building_alias',
        'number',
        'floor',
        'garages',
        'bathrooms',
        'bedrooms',
        'monthly_rent',
    ];

    protected $rememberQueryInput = [
        'sortBy',
        'sortDesc',
    ];

    public function render()
    {
        $apartments = Apartment::available()
            ->ofCurrentUser()
            ->searching($this->search)
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);
                    
        return view('livewire.contracts.select-apartment', [
            'apartments' => $apartments,
        ]);
    }
}
