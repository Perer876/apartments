<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant;
use Livewire\WithPagination;
use App\Traits\Views\WithSorting;
use App\Traits\Views\WithSearch;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithSearch;

    protected $paginationTheme = 'bootstrap';
    
    protected $defaultValue = [
        'sortBy' => 'first_name',
    ];

    public function render()
    {
        # Retrieve only the ids of the records according to the search term
        $tenants = Tenant::search($this->search)->query(function ($query) {
            $query->select('id');
        })->get();

        # Get all the records, and now they can be sorted at database level.
        $tenants = Tenant::whereIn('id', $tenants)
            ->orderBy($this->sortBy, $this->sortDirection())
            ->paginate(10);

        return view('livewire.tenants.index', [
            'tenants' => $tenants,
        ]);
    }
}
