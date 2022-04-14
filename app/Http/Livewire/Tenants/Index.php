<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant;

class Index extends Component
{
    public $search;

    public function render()
    {
        $tenants = Tenant::search($this->search)->get(); 

        return view('livewire.tenants.index', [
            'tenants' => $tenants,
        ]);
    }
}
