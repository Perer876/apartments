<x-base>
    <div class="page-heading">
        <h3>{{ $building->alias }}</h3>
        <p class="text-subtitle text-muted">Mostrando detalle.</p>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Detalles</h4>
                            <hr>
                            <h6 class="card-subtitle">ID</h6>
                            <p class="card-text">{{ $building->id }}</p>
                            <h6 class="card-subtitle">Alias</h6>
                            <p class="card-text">{{ $building->alias }}</p>
                            <h6 class="card-subtitle">Calle</h6>
                            <p class="card-text">{{ $building->street }}</p>
                            <h6 class="card-subtitle">Numero</h6>
                            <p class="card-text">{{ $building->number }}</p>
                            <h6 class="card-subtitle">Código Postal</h6>
                            <p class="card-text">{{ $building->postcode }}</p>
                            <h6 class="card-subtitle">Ciudad</h6>
                            <p class="card-text">{{ $building->city }}</p>
                            <h6 class="card-subtitle">Estado</h6>
                            <p class="card-text">{{ $building->state }}</p>
                            <h6 class="card-subtitle">Año de construcción</h6>
                            @if ($building->builded_at)
                            <p class="card-text">{{ $building->builded_at }}</p>
                            @else
                            <span class="badge bg-light-warning">Sin fecha</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted d-flex justify-content-end">
                            Creado el {{ $building->created_at->format('d/m/Y') }} a las {{ $building->created_at->format('H:i') }}
                        </small>
                        <small class="text-muted d-flex justify-content-end">
                            Actualizado el {{ $building->updated_at->format('d/m/Y') }} a las {{ $building->updated_at->format('H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Opciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="buttons">
                            <a href="/buildings" class="btn btn-primary">Ver todos</a>
                            <a href="/buildings/{{$building->id}}/edit" class="btn btn-warning">Editar</a>
                            <x-modal type="danger" title="Eliminar edificio">
                                <div class="modal-body">
                                    ¿Estas seguro que quieres eliminar este edificio?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Cancelar</span>
                                    </button>
                                    <form action="/buildings/{{$building->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Eliminar">
                                    </form>
                                </div>
                            </x-modal>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>