<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant;

class Index extends Component
{
    public $search;
    public $sortBy = 'name';
    public $sortDesc = false;

    public function render()
    {
        $tenants = Tenant::search($this->search)->get()
            ->sortBy($this->sortBy, SORT_REGULAR, $this->sortDesc); 

        return view('livewire.tenants.index', [
            'tenants' => $tenants,
        ]);
    }

    public function sort ($column)
    {
        if ($this->sortBy == $column)
        {
            $this->sortDesc = $this->sortDesc ? false : true;
        }
        else 
        {
            $this->sortBy = $column;
            $this->sortDesc = false;
        }
    }

    public function sortIcon ($column)
    {
        if ($this->sortBy == $column)
        {
            if ($this->sortDesc)
            {
                return 'bi-sort-alpha-up';
            }
            else 
            {
                return 'bi-sort-alpha-down';
            }
        }
        return 'bi-arrow-down-up';
    }
}
