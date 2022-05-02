<div class="list-group">
    @foreach ($apartments as $apartment)
        <a href="{{$apartment->href}}" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$apartment->number}}</h5>
                <small>$ {{$apartment->monthly_rent}}</small>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <span>
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
        </a>
    @endforeach
</div>