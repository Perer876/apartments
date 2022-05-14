<div class="btn-group mb-md-2 ms-md-2">
    <button class="btn btn-info lh-1" type="button" wire:click="swapSortDirection">
        <i class="{{ $this->sortIcon() }}"></i>
    </button>
    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Ordenar por
    </button>
    <ul class="dropdown-menu shadow">
        <li><button class="dropdown-item{{$this->sortByIs('tenant_name', ' active')}}" 
            type="button" wire:click="sort('tenant_name')">Inquilino</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('apartment_number', ' active')}}" 
            type="button" wire:click="sort('apartment_number')">Número departamento</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('amount_period', ' active')}}"
            type="button" wire:click="sort('amount_period')">Periodo</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('monthly_rent', ' active')}}"
            type="button" wire:click="sort('monthly_rent')">Renta mensual</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('state', ' active')}}"
            type="button" wire:click="sort('state')">Estado</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('start_at', ' active')}}"
            type="button" wire:click="sort('start_at')">Comienzo</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('end_at', ' active')}}"
            type="button" wire:click="sort('end_at')">Finalización</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('cancelled_at', ' active')}}"
            type="button" wire:click="sort('cancelled_at')">Cancelado</button></li>
    </ul>
</div>