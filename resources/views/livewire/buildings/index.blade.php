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
                        <li><button class="dropdown-item{{$this->sortByIs('alias', ' active')}}" 
                            type="button" wire:click="sort('alias')">Alias</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('street', ' active')}}"
                            type="button" wire:click="sort('street')">Calle</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('number', ' active')}}"
                            type="button" wire:click="sort('number')">Numero</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('city', ' active')}}"
                            type="button" wire:click="sort('city')">Ciudad</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('state', ' active')}}"
                            type="button" wire:click="sort('state')">Estado</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('postcode', ' active')}}"
                            type="button" wire:click="sort('postcode')">Código Postal</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('builded_at', ' active')}}"
                            type="button" wire:click="sort('builded_at')">Año de construcción</button></li>
                        <li><button class="dropdown-item{{$this->sortByIs('apartments_count', ' active')}}"
                            type="button" wire:click="sort('apartments_count')">Número de departamentos</button></li>
                    </ul>
                </div>
                <div class="btn-group mb-md-2 ms-md-2" role="group" aria-label="View type check group">
                    <input type="radio" wire:click="view('table')" class="btn-check" name="view-type-options"
                        id="table-view" autocomplete="off" {{ $this->viewIs('table', ' checked') }}>
                    <label class="btn btn-outline-warning" for="table-view">Tabla</label>
                    <input type="radio" wire:click="view('cards')" class="btn-check" name="view-type-options"
                        id="card-view" autocomplete="off" {{ $this->viewIs('cards', ' checked') }}>
                    <label class="btn btn-outline-warning" for="card-view">Tarjetas</label>
                </div>
                @can('create', App\Models\Building::class)
                    <a href="{{route('buildings.create')}}" class="btn btn-primary mb-md-2 ms-md-2">+ Nuevo Edificio</a>
                @endcan
            </div>
        </div>
    </div>

    @include('partial.messages')

    @if ($buildings->count())
        @if ($this->viewIs('table'))
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('alias')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Alias</span>
                                            <i class="{{ $this->sortIcon('alias') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('street')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Calle</span>
                                            <i class="{{ $this->sortIcon('street') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('number')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Número</span>
                                            <i class="{{ $this->sortIcon('number') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('city')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Ciudad</span>
                                            <i class="{{ $this->sortIcon('city') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('state')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Estado</span>
                                            <i class="{{ $this->sortIcon('state') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('postcode')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">CP</span>
                                            <i class="{{ $this->sortIcon('postcode') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('builded_at')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Año</span>
                                            <i class="{{ $this->sortIcon('builded_at') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('apartments_count')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Departamentos</span>
                                            <i class="{{ $this->sortIcon('apartments_count') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buildings as $building)
                                    <tr>
                                        <td>
                                            <i class="bi bi-house"></i>
                                            <a href="{{ $building->href }}" class="link-secondary text-underline-hover">
                                                {{ $building->alias }}
                                            </a>
                                        </td>
                                        <td>{{$building->street}}</td>
                                        <td>{{$building->number}}</td>
                                        <td>{{$building->city}}</td>
                                        <td>{{$building->state}}</td>
                                        <td>{{$building->postcode}}</td>
                                        <td>
                                            @if ($building->builded_at)
                                                {{$building->builded_at}}
                                            @else
                                                <span class="badge bg-light-danger">Sin fecha</span>
                                            @endif
                                        </td>
                                        <td>{{$building->apartments_count}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif ($this->view == 'cards')
            <div class="row">
                @foreach ($buildings as $building)
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light-success">
                                <div class="d-flex justify-content-between align-items-start">
                                    <a class="stretched-link" href="{{ $building->href }}">
                                        <h4 class="card-title">
                                            <i class="bi bi-house-fill me-1"></i>
                                            {{ $building->alias }}
                                        </h4>
                                    </a>
                                    <span class="badge bg-success fs-6">
                                        {{ $building->apartments_count}}
                                        <i class="bi bi-door-closed-fill"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">
                                        {{$building->address}}
                                        <br>
                                        {{$building->location}}
                                        <br>
                                        {{$building->postcode}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        @if( strlen($this->search) == 0 )
            <div class="alert alert-light-info shadow-sm">
                <i class="bi-exclamation-circle-fill me-2"></i> 
                No hay edificios.
            </div>
        @else            
            <div class="alert alert-light-warning shadow-sm">
                <i class="bi-search me-2"></i> 
                No se encontraron edificios con esa información.
            </div>
        @endif
    @endif
    <div class="text-center">
        {{ $buildings->links() }}
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
