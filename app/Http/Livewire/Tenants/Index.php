<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tenant;

class Index extends Component
{
    use WithPagination;

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
        # Old way to retrive the records, without possibility to manage properly pagination and ordering at the same time.
        /* $tenants = Tenant::search($this->search)->get()
            ->sortBy($this->sortBy, SORT_REGULAR, $this->sortDesc); */

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

    public function sort($column)
    {
        if ($this->sortBy == $column) {
            $this->sortDesc = $this->sortDesc ? false : true;
        } else {
            $this->sortBy = $column;
            $this->sortDesc = false;
            $this->resetPage();
        }
    }

    public function sortIcon($column)
    {
        if ($this->sortBy == $column) {
            if ($this->sortDesc) {
                return 'bi-sort-alpha-up';
            } else {
                return 'bi-sort-alpha-down';
            }
        }
        return 'bi-arrow-down-up';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
