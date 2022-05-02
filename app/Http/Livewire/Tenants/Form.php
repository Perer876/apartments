<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant;
use App\Traits\Forms\WithValidateChanges;

class Form extends Component
{
    use WithValidateChanges;

    public Tenant $tenant;

    public function mount($tenant = null)
    {
        $this->tenant = $tenant ?? new Tenant();
    }

    protected function rules()
    {
        return [
            'tenant.first_name' => ['required'],
            'tenant.last_name' => ['required'],
            'tenant.phone' => ['nullable','string','min:4'],
            'tenant.birthday' => ['nullable','date','before:now'],
        ];
    }

    public function save()
    {
        $this->validateAll = true;
        $this->validate();
        
        $isUpdatingTenant = $this->tenant->id;
        $this->tenant->save();

        # When you need to update data
        if($isUpdatingTenant)
        {
            session()->push('messages', [
                'text' => 'Datos actualizados satisfactoriamente.',
                'color' => 'success',
                'icon' => 'bi bi-hand-thumbs-up'
            ]);
            return redirect($this->tenant->href); 
        }

        # When you add new tenant
        session()->push('messages', [
            'text' => 'Inquilino agregado exitosamente. Ver',
            'link' => [
                'href' => '/tenants/'. $this->tenant->id, 
                'text' => $this->tenant->name
            ],
            'color' => 'success',
            'icon' => 'bi bi-check-circle',
        ]);
        return redirect('tenants');
    }
    
    public function render()
    {
        return view('livewire.tenants.form');
    }
}
