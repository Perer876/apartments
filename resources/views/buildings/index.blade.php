<x-base>
    <div class="page-heading">
        <h3>Edificios</h3>
        <p class="text-subtitle text-muted">Aquí puedes administrar los diferentes edificios departamentales de los cuales quieras llevar el control. </p>
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
                        </div>
                    </div>
                </div>
            </div>
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
        </section>
    </div>    
</x-base>