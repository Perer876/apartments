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
        $buildings = Building::ofCurrentUser()
            ->searching($this->search)
            ->withCount('apartments')
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);

        return view('livewire.buildings.index', [
            'buildings' => $buildings,
        ]);
    }
}
