<?php

namespace App\Http\Livewire\Apartments;

use Livewire\Component;
use App\Models\Apartment;
use App\Models\Building;
use Livewire\WithPagination;
use App\Traits\Views\WithSorting;
use App\Traits\Views\WithSearch;
use App\Traits\Views\WithViewTypes;
use App\Traits\Views\RememberQueryString;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithSearch;
    use WithViewTypes;
    use RememberQueryString;

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

    protected $rememberQueryInput = [
        'sortBy',
        'sortDesc',
        'view',
    ];

    public function render()
    {
        $apartments = Apartment::select('apartments.*' ,'buildings.alias as building_alias')
            ->join('buildings', 'buildings.id', '=', 'building_id')
            ->searching($this->search)
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);
                    
        return view('livewire.apartments.index', [
            'apartments' => $apartments,
        ]);
    }
}
