<div class="btn-group mb-md-2 ms-md-2">
    <button class="btn btn-info lh-1" type="button" wire:click="swapSortDirection">
        <i class="{{ $this->sortIcon() }}"></i>
    </button>
    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Ordenar por
    </button>
    <ul class="dropdown-menu shadow">
        <li><button class="dropdown-item{{$this->sortByIs('building_alias', ' active')}}" 
            type="button" wire:click="sort('building_alias')">Alias del edificio
        </button></li>
        <li><button class="dropdown-item{{$this->sortByIs('number', ' active')}}" 
            type="button" wire:click="sort('number')">Número departamento</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('floor', ' active')}}"
            type="button" wire:click="sort('floor')">Piso</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('garages', ' active')}}"
            type="button" wire:click="sort('garages')">Cocheras</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('bathrooms', ' active')}}"
            type="button" wire:click="sort('bathrooms')">Baños</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('bedrooms', ' active')}}"
            type="button" wire:click="sort('bedrooms')">Dormitorios</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('monthly_rent', ' active')}}"
            type="button" wire:click="sort('monthly_rent')">Renta mensual</button></li>
        <li><button class="dropdown-item{{$this->sortByIs('status', ' active')}}"
            type="button" wire:click="sort('status')">Contrato</button></li>
    </ul>
</div>