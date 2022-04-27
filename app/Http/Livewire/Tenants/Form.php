<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant;
use App\Traits\Forms\WithValidateChanges;

class Form extends Component
{
    use WithValidateChanges;

    public Tenant $tenant;

    public function mount()
    {
        $this->tenant = new Tenant();
    }

    protected function rules()
    {
        return [
            'tenant.first_name' => ['required'],
            'tenant.last_name' => ['required'],
            'tenant.phone' => ['required','string','min:4'],
            'tenant.birthday' => ['required','date', 'before:now'],
        ];
    }

    public function save()
    {
        $this->validateAll = true;
        $this->validate();
        
        $this->tenant->save();

        session()->push('messages', [
            'text' => 'Inquilino agregado exitosamente.',
            'link' => [
                'href' => '/tenants/'. $this->tenant->id, 
                'text' => 'Ver inquilino.'
            ],
            'color' => 'light-success',
            'icon' => 'bi bi-check-circle',
        ]);
        return redirect('tenants');
    }
    
    public function render()
    {
        return view('livewire.tenants.form');
    }
}
