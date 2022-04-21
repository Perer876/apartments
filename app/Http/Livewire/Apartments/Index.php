<?php

namespace App\Http\Livewire\Apartments;

use Livewire\Component;
use App\Models\Apartment;
use Livewire\WithPagination;
use App\Traits\Views\WithSorting;
use App\Traits\Views\WithSearch;
use App\Traits\Views\WithViewTypes;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithSearch;
    use WithViewTypes;

    protected $paginationTheme = 'bootstrap';

    protected $defaultValue = [
        'sortBy' => 'number',
        'view' => 'list',
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

    protected $validViewValues = [
        'table',
        'list',
    ];

    public function render()
    {
        # Retrieve only the ids of the records according to the search term
        $apartments = Apartment::search($this->search)->query(function ($query) {
            $query->select('id');
        })->get();

        # Get all the records, and now they can be sorted at database level.
        $apartments = Apartment::select('apartments.*' ,'buildings.alias as building_alias')
            ->join('buildings', 'buildings.id', '=', 'building_id')
            ->whereIn('apartments.id', $apartments)
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);
            
        return view('livewire.apartments.index', [
            'apartments' => $apartments,
        ]);
    }
}
