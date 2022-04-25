<?php

namespace App\Http\Livewire\Buildings;

use Livewire\Component;
use App\Models\Building;
use App\Traits\Views\RememberQueryString;
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
    use RememberQueryString;

    protected $paginationTheme = 'bootstrap';
    
    protected $defaultValue = [
        'sortBy' => 'alias',
        'view' => 'cards',
    ];

    protected $validSortByValues = [
        'alias',
        'street',
        'number',
        'postcode',
        'city',
        'state',
        'builded_at',
        'apartments_count',
    ];

    protected $validViewValues = [
        'table',
        'cards',
    ];

    protected $rememberQueryInput = [
        'sortBy',
        'sortDesc',
        'view',
    ];

    public function render()
    {
        # Retrieve only the ids of the records according to the search term
        $buildings = Building::search($this->search)->query(function ($query) {
            $query->select('id');
        })->get();

        # Get all the records, and now they can be sorted at database level.
        $buildings = Building::whereIn('id', $buildings)
            ->withCount('apartments')
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);

        return view('livewire.buildings.index', [
            'buildings' => $buildings,
        ]);
    }
}
