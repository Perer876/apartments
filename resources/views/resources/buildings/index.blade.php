<x-base>
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edificios</h3>
                <p class="text-subtitle text-muted">Aquí puedes administrar los diferentes edificios departamentales de los cuales quieras llevar el control. </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Edificios</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Opciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="buttons">
                            <a href="/buildings/create" class="btn btn-primary">Nuevo edificio</a>
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="view-dropdown-button" data-bs-toggle="dropdown" aria-expanded="false">
                                Vista
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="view-dropdown-button">
                                <li><a class="dropdown-item" href="/buildings?view=cards">Tarjetas</a></li>
                                <li><a class="dropdown-item" href="/buildings?view=table">Tabla</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @if ($view == 'cards')
                @foreach ($buildings as $building)
                <div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title">{{$building->alias}}</h4>
                                <p class="card-text">
                                    {{$building->street . ' ' . $building->number}}
                                    <br>
                                    {{$building->city . ', ' . $building->state}}
                                    <br>
                                    {{$building->postcode}}
                                </p>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a class="btn btn-info" href="/buildings/{{ $building->id }}">Detalle</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @elseif ($view == 'table')
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Listado de Edificios</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>Alias</th>
                                        <th>Calle</th>
                                        <th>Número</th>
                                        <th>Ciudad</th>
                                        <th>Estado</th>
                                        <th>CP</th>
                                        <th>Año</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buildings as $building)
                                    <tr>
                                        <th><a href="/buildings/{{ $building->id }}">{{$building->alias}}</a></th>
                                        <td>{{$building->street}}</td>
                                        <td>{{$building->number}}</td>
                                        <td>{{$building->city}}</td>
                                        <td>{{$building->state}}</td>
                                        <td>{{$building->postcode}}</td>
                                        @if ($building->builded_at)
                                            <td>{{$building->builded_at}}</td>
                                        @else
                                            <td><span class="badge bg-light-warning">Sin fecha</span></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>

    <x-slot name="stylesheets">
        <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    </x-slot>
    
    <x-slot name="scripts">
        <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    </x-slot>
</x-base>