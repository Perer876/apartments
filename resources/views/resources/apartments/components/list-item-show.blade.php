@php
    if(!isset($hide)) $hide = [];   
@endphp
<div class="d-md-flex w-100 justify-content-between text-center">
    <div class="d-flex justify-content-between justify-content-md-start align-items-baseline">
        <h4 class="d-inline-block me-3">{{$apartment->number}}</h4>
        @if(!in_array('contract', $hide))
            @include('resources.contracts.components.status-show', ['contract' => $apartment->lastestContract])
        @endif
    </div>
    @if(!in_array('building', $hide))
        <small class="fw-lighter d-block fs-6">{{$apartment->building->alias}}</small>
    @endif
    <span class="fs-5">$ {{$apartment->monthly_rent}}</span>
</div>
<div class="d-flex w-100 justify-content-between mb-1">
    <span class="text-start">
        <span class="badge bg-light-success mb-1">
            @if ($apartment->floor == 0)
                Planta baja
            @else
                {{$apartment->floor}}° piso
            @endif
        </span>
        <span class="badge bg-light-warning">
            @if ($apartment->garages == 0)
                Sin cocheras
            @elseif ($apartment->garages == 1)
                1 cochera
            @else
                {{$apartment->garages}} cocheras
            @endif
        </span>
    </span>
    <span class="text-end">
        <span class="badge bg-light-info mb-1">
            @if ($apartment->bathrooms == 0)
                Sin baños
            @elseif ($apartment->bathrooms == 1)
                1 baño
            @else
                {{$apartment->bathrooms}} baños
            @endif
        </span>
        <span class="badge bg-light-danger">
            @if ($apartment->bedrooms == 0)
                Sin dormitorios :c
            @elseif ($apartment->bedrooms == 1)
                1 dormitorio
            @else
                {{$apartment->bedrooms}} dormitorios
            @endif
        </span>
    </span>
</div>
@if(!in_array('building', $hide))
    <div class="row">
        <span class="col-12 col-md-6 text-md-start text-center">
            {{$apartment->building->address}}
        </span>
        <span class="col-12 col-md-6 fw-lighter text-md-end text-center">
            {{$apartment->building->location}}
        </span>
    </div>
@endif