<x-base>
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
    <div class="page-content">
        <section class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Detalles</h4>
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
                            <p class="card-text">{{ $apartment->monthly_rent }}</p>
                            <div class="buttons text-center">
                                <a href="/apartments/{{$apartment->id}}/edit" class="btn btn-outline-warning">Editar</a>
                                <x-modal name="confirm-delete" type="danger" class="btn btn-outline-danger">
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
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted d-flex justify-content-end">
                            Creado el {{ $apartment->created_at->format('d/m/Y') }} a las {{ $apartment->created_at->format('H:i') }}
                        </small>
                        <small class="text-muted d-flex justify-content-end">
                            Actualizado el {{ $apartment->updated_at->format('d/m/Y') }} a las {{ $apartment->updated_at->format('H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">
                                <div class="d-flex w-100 justify-content-between">
                                    Dirección
                                    <a href="/buildings/{{ $apartment->building->id }}" class="btn btn-outline-info">Ver</a>
                                </div>
                            </h4>
                            <p class="card-text">
                                {{$apartment->building->street . ' ' . $apartment->building->number}}
                                <br>
                                {{$apartment->building->city . ', ' . $apartment->building->state}}
                                <br>
                                {{$apartment->building->postcode}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>