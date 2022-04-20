<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Termino de busqueda">
        </div>
        <div class="col-12 col-md-6 text-end">
            <div class="btn-group mb-4 ms-2" role="group" aria-label="View type check group">
                <input type="radio" wire:click="view('table')" class="btn-check" name="view-type-options"
                    id="table-view" autocomplete="off" {{ $this->viewIs('table', ' checked') }}>
                <label class="btn btn-outline-warning" for="table-view">Tabla</label>
                <input type="radio" wire:click="view('cards')" class="btn-check" name="view-type-options"
                    id="card-view" autocomplete="off" {{ $this->viewIs('cards', ' checked') }}>
                <label class="btn btn-outline-warning" for="card-view">Tarjetas</label>
            </div>
            <a href="/tenants/create" class="btn btn-primary mb-4 ms-2">+ Nuevo Inquilino</a>
        </div>
    </div>
    @if ($tenants->count())
        @if ($this->viewIs('table') )
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('first_name')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            Nombre
                                            <i class="{{ $this->sortIcon('first_name') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('phone')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            Telefono
                                            <i class="{{ $this->sortIcon('phone') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('birthday')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            Fecha de nacimiento
                                            <i class="{{ $this->sortIcon('birthday') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>{{ $tenant->name }}</td>
                                        <td>{{ $tenant->phone }}</td>
                                        <td>{{ $tenant->birthday }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $tenants->links() }}
                        </div>
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
                                <h4 class="card-title">{{ $tenant->name }}</h4>
                                <p class="card-text">
                                    {{ $tenant->phone }}
                                    <br>
                                    {{ $tenant->birthday }}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a class="btn btn-info" href="/tenants/{{ $tenant->id }}">Detalle</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
            <div class="text-center">
                {{ $tenants->links() }}
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
</div>
