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
                        <li><button class="dropdown-item" type="button" wire:click="sort('first_name')">Nombre</button>
                        </li>
                        <li><button class="dropdown-item" type="button" wire:click="sort('phone')">Telefono</button>
                        </li>
                        <li><button class="dropdown-item" type="button" wire:click="sort('birthday')">Edad</button>
                        </li>
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
                <a href="/tenants/create" class="btn btn-primary mb-md-2 ms-md-2">+ Nuevo Inquilino</a>
            </div>
        </div>
    </div>
    @if ($tenants->count())
        @if ($this->viewIs('table'))
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('first_name')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Nombre
                                            <i class="{{ $this->sortIcon('first_name') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('phone')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Telefono
                                            <i class="{{ $this->sortIcon('phone') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('birthday')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between lh-1">
                                            Edad
                                            <i class="{{ $this->sortIcon('birthday') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td><a href="{{ $tenant->href }}" class="link-secondary">{{ $tenant->name }}</a></td>
                                        <td>{{ $tenant->phone }}</td>
                                        <td>{{ $tenant->age }}</td>
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
                                        <h4 class="card-title">{{ $tenant->name }}</h4>
                                    </a>
                                    <strong>Tel.</strong> {{ $tenant->phone }}
                                    <p class="card-text text-end">
                                        <small class="">{{ $tenant->age }} años</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        <div class="card shadow-sm">
            <div class="card-content">
                <div class="card-body">
                    <p>No hay inquilinos</p>
                </div>
            </div>
        </div>
    @endif
    <div class="text-center">
        {{ $tenants->links() }}
    </div>
</div>
