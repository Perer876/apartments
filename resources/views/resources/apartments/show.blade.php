<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Departamento: {{ $apartment->number }}</h3>
                <p class="text-subtitle text-muted">Mostrando detalle.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings">Edificios</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings/{{$apartment->building->id}}">{{$apartment->building->alias}}</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings/{{$apartment->building->id}}/apartments">Departamentos</x-breadcrumb.item>
                    <x-breadcrumb.item>{{$apartment->number}}</x-breadcrumb.item>
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
                            <h4 class="card-title">
                                <i class="bi bi-door-closed me-2"></i>
                                Detalles
                            </h4>
                            <hr>
                            <h6 class="card-subtitle">Número</h6>
                            <p class="card-text">{{ $apartment->number }}</p>
                            <h6 class="card-subtitle">Piso</h6>
                            <p class="card-text">{{$apartment->floor == 0 ? 'Planta baja' : $apartment->floor . '° piso'}}</p>
                            <h6 class="card-subtitle">Cocheras</h6>
                            <p class="card-text">{{ $apartment->garages }}</p>
                            <h6 class="card-subtitle">Baños</h6>
                            <p class="card-text">{{ $apartment->bathrooms }}</p>
                            <h6 class="card-subtitle">Dormitorios</h6>
                            <p class="card-text">{{ $apartment->bedrooms }}</p>
                            <h6 class="card-subtitle">Renta mensual</h6>
                            <p class="card-text">$ {{ $apartment->monthly_rent }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-md-flex w-100 justify-content-between">
                            <div class="buttons text-center text-md-left">
                                <a href="/apartments/{{$apartment->id}}/edit" class="btn btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                    Editar
                                </a>
                                <x-modal name="confirm-delete" type="danger" class="btn btn-outline-danger">
                                    <x-slot name="trigger">
                                        <i class="bi bi-trash"></i>
                                        Eliminar
                                    </x-slot>
                                    <x-slot name="title">
                                        Eliminar departamento
                                    </x-slot>
                                    ¿Estas seguro que quieres eliminar este este departamento?
                                    <x-slot name="footer">
                                        <x-modal.dismiss-button class="btn btn-light-secondary">
                                            Cancelar
                                        </x-modal.dismiss-button>
                                        <form action="/apartments/{{$apartment->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Eliminar">
                                        </form>
                                    </x-slot>
                                </x-modal>
                            </div>
                            <div>
                                <small class="text-muted d-flex justify-content-end">
                                    Creado el {{ $apartment->created_at->format('d/m/Y') }} a las {{ $apartment->created_at->format('H:i') }}
                                </small>
                                <small class="text-muted d-flex justify-content-end">
                                    Actualizado el {{ $apartment->updated_at->format('d/m/Y') }} a las {{ $apartment->updated_at->format('H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">
                                <div class="d-flex w-100 justify-content-between">
                                    <span>
                                        <i class="bi bi-signpost me-2"></i>
                                        Dirección
                                    </span> 
                                    <a href="/buildings/{{ $apartment->building->id }}" class="btn btn-outline-info">Ver</a>
                                </div>
                            </h4>
                            @include('resources.buildings.components.address-show', ['building' => $apartment->building])
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>