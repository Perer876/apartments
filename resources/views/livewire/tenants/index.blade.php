<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <input type="text" wire:model="search" class="form-control" id="search_term"
                placeholder="Termino de busqueda">
        </div>
        <div class="col-12 col-md-6 text-end mb-3">
            <a href="/tenants/create" class="btn btn-primary">+ Nuevo Inquilino</a>
        </div>
    </div>
    <div class="card">
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

            @if (count($tenants) == 0)
                <div class="card-body">
                    <p>No hay inquilinos</p>
                </div>
            @endif
        </div>
    </div>
</div>
