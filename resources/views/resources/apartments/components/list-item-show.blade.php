@php
    if(!isset($hide)) $hide = [];   
@endphp
<div class="d-md-flex w-100 justify-content-between">
    <h5 class="mb-1">{{$apartment->number}}</h5>
    @if(!in_array('building', $hide))
        <small class="fw-lighter d-block">{{$apartment->building->address}}</small>
    @endif
    <span>$ {{$apartment->monthly_rent}}</span>
</div>
<div class="d-flex w-100 justify-content-between">
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
        <span class="col-12 col-md-6 text-start">
            {{$apartment->building->alias}}
        </span>
        <span class="col-12 col-md-6 fw-lighter text-end">
            {{$apartment->building->location}}
        </span>
    </div>
@endif