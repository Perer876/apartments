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
                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ordenar por
                    </button>
                    <ul class="dropdown-menu shadow">
                        <li><button @class(['dropdown-item', 'active' => $this->sortByIs('first_name')]) 
                            type="button" wire:click="sort('first_name')">
                            Nombre
                        </button></li>
                        <li><button @class(['dropdown-item', 'active' => $this->sortByIs('phone')]) 
                            type="button" wire:click="sort('phone')">
                            Telefono
                        </button></li>
                        <li><button @class(['dropdown-item', 'active' => $this->sortByIs('birthday')]) 
                            type="button" wire:click="sort('birthday')">
                            Edad
                        </button></li>
                        <li><button @class(['dropdown-item', 'active' => $this->sortByIs('status')]) 
                            type="button" wire:click="sort('status')">
                            Estado
                        </button></li>
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
                @can('create', App\Models\Tenant::class)
                    <a href="/tenants/create" class="btn btn-primary mb-md-2 ms-md-2">+ Nuevo Inquilino</a>
                @endcan
            </div>
        </div>
    </div>

    @include('partial.messages')

    @if ($tenants->count())
        @if ($this->viewIs('table'))
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('first_name')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Nombre</span>
                                            <i class="{{ $this->sortIcon('first_name') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('phone')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Telefono</span>
                                            <i class="{{ $this->sortIcon('phone') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('birthday')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Edad</span>
                                            <i class="{{ $this->sortIcon('birthday') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('status')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Estado</span>
                                            <i class="{{ $this->sortIcon('status') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>
                                            <i class="bi bi-person"></i>
                                            <a href="{{ $tenant->href }}" class="link-secondary text-underline-hover">
                                                {{ $tenant->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($tenant->phone)
                                                {{ $tenant->phone }}
                                            @else
                                                <span class="badge bg-light-danger">Sin teléfono</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($tenant->birthday)
                                                {{$tenant->age}}
                                            @else
                                                <span class="badge bg-light-danger">Desconocida</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('resources.contracts.components.status-show', ['contract' => $tenant->lastestContract])
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif ($this->view == 'cards')
            <div class="row">
                @foreach ($tenants as $tenant)
                    <div class="col-xl-4 col-md-6 col-sm-12">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body">
                                    <a class="stretched-link" href="{{ $tenant->href }}">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <h4 class="card-title">
                                                <i class="bi bi-person-fill"></i>
                                                {{ $tenant->name }}
                                            </h4>
                                            @include('resources.contracts.components.status-show', ['contract' => $tenant->lastestContract])
                                        </div>
                                    </a>
                                    @if($tenant->phone)
                                        <strong>Tel.</strong> {{ $tenant->phone }}
                                    @else
                                        <span class="badge bg-light-warning">Sin teléfono</span>
                                    @endif
                                    <p class="card-text text-end">
                                        @if($tenant->birthday)
                                            <small>{{ $tenant->age }} años</small>
                                        @else
                                            <span class="badge bg-light-danger">Edad desconocida</span>
                                        @endif
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
                <i class="bi-exclamation-circle-fill"></i> 
                No tienes inquilinos.
            </div>
        @else            
            <div class="alert alert-light-warning shadow-sm">
                <i class="bi-search"></i> 
                No se encontraron inquilinos con esa información.
            </div>
        @endif
    @endif
    <div class="text-center">
        {{ $tenants->links() }}
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
