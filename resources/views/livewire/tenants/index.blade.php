<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <input type="text" wire:model="search" class="form-control" id="search_term" placeholder="Termino de busqueda">
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
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Fecha de nacimiento</th>
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
            </div>

            @if (count($tenants) == 0)
                <div class="card-body">
                    <p>No hay inquilinos</p>
                </div>
            @endif
        </div>
    </div>
</div>
