<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tenant;
use App\Traits\Views\WithSorting;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $sortBy = 'first_name';
    public $sortDesc = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'first_name'],
        'sortDesc' => ['except' => false],
    ];

    public function render()
    {
        # Retrieve only the ids of the records according to the search term
        $tenants = Tenant::search($this->search)->query(function ($query) {
            $query->select('id');
        })->get();

        # Get all the records, and now they can be sorted at database level.
        $tenants = Tenant::whereIn('id', $tenants)
            ->orderBy($this->sortBy, $this->sortDesc ? 'desc' : 'asc')
            ->paginate(10);

        return view('livewire.tenants.index', [
            'tenants' => $tenants,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
