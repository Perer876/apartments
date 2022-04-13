<x-base>
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Departamentos</h3>
                <p class="text-subtitle text-muted">Aquí puedes administrar los diferentes departamentos que forman parte de tus edificios. </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    @isset ($building)
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings">Edificios</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings/{{$building->id}}">{{$building->alias}}</x-breadcrumb.item>
                    <x-breadcrumb.item>Departamentos</x-breadcrumb.item>
                    @else
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Departamentos</x-breadcrumb.item>
                    @endif
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Listado de departamentos @isset($building)de {{$building->alias}}@endif</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12 mb-2 d-flex justify-content-end">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="view-dropdown-button" data-bs-toggle="dropdown" aria-expanded="false">
                                Vista
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="view-dropdown-button">
                                <li><a class="dropdown-item" href="/{{$request->path()}}?view=table">Tabla</a></li>
                                <li><a class="dropdown-item" href="/{{$request->path()}}?view=list">Lista</a></li>
                            </ul>
                        </div>
                        @if ($view == 'table')
                        <table class="table table-hover" id="table-apartments">
                            <thead>
                                <tr>
                                    <th>Edificio</th>
                                    <th>Número</th>
                                    <th>Piso</th>
                                    <th>Cocheras</th>
                                    <th>Baños</th>
                                    <th>Dormitorios</th>
                                    <th>Renta mensual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apartments as $apartment)
                                <tr>
                                    <td><a href="/buildings/{{ $apartment->building->id }}">{{$apartment->building->alias}}</a></td>
                                    <td><a href="/apartments/{{ $apartment->id }}">{{$apartment->number}}</a></td>
                                    <td>{{$apartment->floor}}</td>
                                    <td>{{$apartment->garages}}</td>
                                    <td>{{$apartment->bathrooms}}</td>
                                    <td>{{$apartment->bedrooms}}</td>
                                    <td>{{$apartment->monthly_rent}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <x-slot name="stylesheets">
                            <link rel="stylesheet" href="{{asset('assets/vendors/simple-datatables/style.css')}}">
                        </x-slot>
                        
                        <x-slot name="scripts">
                            <script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>
                            <script>
                                // Simple Datatable
                                let table1 = document.querySelector('#table-apartments');
                                let dataTable = new simpleDatatables.DataTable(table1);
                            </script>
                        </x-slot>
                        @elseif ($view == 'list')
                            @if (count($apartments) == 0) 
                            <p>No hay ningun departamento<p>
                            @endif
                            <div class="list-group">
                                @foreach ($apartments as $apartment)
                                <a href="/apartments/{{$apartment->id}}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$apartment->number}}</h5>
                                        <small>$ {{$apartment->monthly_rent}}</small>
                                    </div>
                                    <span class="badge bg-light-success">
                                        @if ($apartment->floor == 0)
                                        Planta baja
                                        @else
                                        {{$apartment->floor}}° piso
                                        @endif
                                    </span>
                                </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-base>