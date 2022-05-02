<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant;
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
        'sortBy' => 'first_name',
        'view' => 'table',
    ];

    protected $validSortByValues = [
        'first_name',
        'phone',
        'birthday',
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
        $tenants = Tenant::searching($this->search)
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);

        return view('livewire.tenants.index', [
            'tenants' => $tenants,
        ]);
    }
}
