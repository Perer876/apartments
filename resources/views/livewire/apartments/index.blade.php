<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Termino de busqueda">
        </div>
        <div class="col-12 col-md-6 text-end">
            <div class="d-grid gap-2 d-md-block mb-4">
                <div class="btn-group mb-md-2 ms-md-2">
                    <button class="btn btn-info lh-1" type="button" wire:click="swapSortDirection">
                        <i class="{{ $this->sortIcon() }}"></i>
                    </button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Ordenar por
                    </button>
                    <ul class="dropdown-menu shadow">
                        <li><button class="dropdown-item{{$this->sortByIs('building_alias', ' active')}}" 
                            type="button" wire:click="sort('building_alias')">Alias del edificio</button></li>
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
                    </ul>
                </div>
                <div class="btn-group mb-md-2 ms-md-2" role="group" aria-label="View type check group">
                    <input type="radio" wire:click="view('table')" class="btn-check" name="view-type-options"
                        id="table-view" autocomplete="off" {{ $this->viewIs('table', ' checked') }}>
                    <label class="btn btn-outline-warning" for="table-view">Tabla</label>
                    <input type="radio" wire:click="view('list')" class="btn-check" name="view-type-options"
                        id="card-view" autocomplete="off" {{ $this->viewIs('list', ' checked') }}>
                    <label class="btn btn-outline-warning" for="card-view">Lista</label>
                </div>
            </div>
        </div>
    </div>
    @if ($apartments->count())
        @if ($this->viewIs('table'))
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('building_alias')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Edificio
                                            <i class="{{ $this->sortIcon('building_alias') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('number')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Número
                                            <i class="{{ $this->sortIcon('number') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('floor')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Piso
                                            <i class="{{ $this->sortIcon('floor') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('garages')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Cocheras
                                            <i class="{{ $this->sortIcon('garages') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('bathrooms')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Baños
                                            <i class="{{ $this->sortIcon('bathrooms') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('bedrooms')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Dormitorios
                                            <i class="{{ $this->sortIcon('bedrooms') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('monthly_rent')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Renta mensual
                                            <i class="{{ $this->sortIcon('monthly_rent') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apartments as $apartment)
                                    <tr>
                                        <td><a href="{{$apartment->building->href }}" class="link-secondary">{{$apartment->building->alias}}</a></td>
                                        <td><a href="{{ $apartment->href }}" class="link-secondary">{{$apartment->number}}</a></td>
                                        <td>{{$apartment->floor}}</td>
                                        <td>{{$apartment->garages}}</td>
                                        <td>{{$apartment->bathrooms}}</td>
                                        <td>{{$apartment->bedrooms}}</td>
                                        <td>{{$apartment->monthly_rent}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif ($this->view == 'list')
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-8 col-xl-12">
                    <div class="card shadow-sm">
                        <div class="list-group">
                            @foreach ($apartments as $apartment)
                            <a href="{{$apartment->href}}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{$apartment->number}}</h5>
                                    <small>$ {{$apartment->monthly_rent}}</small>
                                </div>
                                <span class="badge bg-light-success">
                                    @if ($apartment->floor == 0)
                                    Planta baja
                                    @else
                                    {{$apartment->floor}}° piso
                                    @endif
                                </span>
                                <span class="badge bg-light-warning">
                                    @if ($apartment->garages == 0)
                                        Sin cocheras
                                    @elseif ($apartment->garages == 1)
                                        1 cochera
                                    @else
                                        {{$apartment->garages}} cocheras
                                    @endif
                                </span>
                                <span class="badge bg-light-info">
                                    @if ($apartment->bathrooms == 0)
                                        Sin baños
                                    @elseif ($apartment->bathrooms == 1)
                                        1 baño
                                    @else
                                        {{$apartment->bathrooms}} baños
                                    @endif
                                </span>
                                <span class="badge bg-light-danger">
                                    @if ($apartment->bedrooms == 0)
                                        Sin dormitorios :c
                                    @elseif ($apartment->bedrooms == 1)
                                        1 dormitorio
                                    @else
                                        {{$apartment->bedrooms}} dormitorios
                                    @endif
                                </span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="card shadow-sm">
            <div class="card-content">
                <div class="card-body">
                    <p>No hay departamentos</p>
                </div>
            </div>
        </div>
    @endif
    <div class="text-center">
        {{ $apartments->links() }}
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
