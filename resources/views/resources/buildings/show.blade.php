<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edificio: {{ $building->alias }}</h3>
                <p class="text-subtitle text-muted">Mostrando detalle.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings">Edificios</x-breadcrumb.item>
                    <x-breadcrumb.item>{{$building->alias}}</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    @include('partial.messages')
    <div class="page-content">
        <section class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Detalles</h4>
                            <hr>
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
                <div class="card shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Departamentos</h4>
                            <hr>
                            @if (!$building->apartments->count()) 
                            <p>No hay ningun departamento<p>
                            @endif
                            @include('resources.apartments.views.list', ['apartments' => $building->apartments])
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