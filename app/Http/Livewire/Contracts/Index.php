<?php

namespace App\Http\Livewire\Contracts;

use Livewire\Component;
use App\Models\Contract;
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
        'sortBy' => 'state',
        'sortDesc' => true,
        'view' => 'table',
    ];

    protected $validSortByValues = [
        'tenant_name',
        'apartment_number',
        'amount_period',
        'monthly_rent',
        'state',
        'start_at',
        'end_at',
        'cancelled_at',
    ];

    protected $validViewValues = [
        'table',
        'cards',
    ];

    protected $rememberQueryInput = [
        'view',
    ];

    public $stateColor = [
        0 => 'danger',
        1 => 'primary',
        2 => 'warning',
        3 => 'success'
    ];

    public function render()
    {
        $contracts = Contract::select('contract.*',
                'tenants.first_name as tenant_name',
                'apartments.number as apartment_number',
                Contract::calculatedStatus('state'),
                Contract::calculatedPeriod('amount_period')
            )
            ->joinTenant()
            ->joinApartment()
            ->ofCurrentUser()
            ->searching($this->search)
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(12);

        return view('livewire.contracts.index', compact('contracts'));
    }
}
