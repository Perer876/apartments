<x-base>
    <div class="page-heading">
        <h3>Edificio: {{ $building->alias }}</h3>
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
                            <div class="buttons text-center">
                                <a href="/buildings/{{$building->id}}/edit" class="btn btn-outline-warning">Editar</a>
                                <x-modal name="confirm-delete" type="danger" class="btn btn-outline-danger">
                                    <x-slot name="title">
                                        Eliminar edificio
                                    </x-slot>
                                    ¿Estas seguro que quieres eliminar este edificio?
                                    <x-slot name="footer">
                                        <x-modal.dismiss-button class="btn btn-light-secondary">
                                            Cancelar
                                        </x-modal.dismiss-button>
                                        <form action="/buildings/{{$building->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Eliminar">
                                        </form>
                                    </x-slot>
                                </x-modal>
                            </div>
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
            <div class="col-md-6 col-sm-12">
                
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Departamentos</h4>
                            <hr>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">List group item heading</h5>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">
                                        Donec id elit non mi porta gravida at eget metus. Maecenas sed
                                        diam eget risus varius blandit.
                                    </p>
                                    <small>Donec id elit non mi porta.</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">List group item heading</h5>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">
                                        Donec id elit non mi porta gravida at eget metus. Maecenas sed
                                        diam eget risus varius blandit.
                                    </p>
                                    <small>Donec id elit non mi porta.</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">List group item heading</h5>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">
                                        Donec id elit non mi porta gravida at eget metus. Maecenas sed
                                        diam eget risus varius blandit.
                                    </p>
                                    <small>Donec id elit non mi porta.</small>
                                </a>
                            </div>
                            <div class="text-center">
                                <a href="/buildings/{{$building->id}}/apartments/create" class="btn btn-outline-primary mt-3">+ Agregar departamento</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>