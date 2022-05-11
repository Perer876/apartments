<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Buscar departamento">
        </div>
        <div class="col-12 col-md-6">
            <div class="d-grid gap-2 d-block mb-4">
                @include('resources.apartments.components.sortby-dropdown')
            </div>
        </div>
        <div class="col-12">
            <div class="d-grid gap-2">
                <div class="btn-group-vertical" role="group" aria-label="Select apartment">
                @foreach ($apartments as $apartment)
                    <input type="radio" class="btn-check" name="apartment_id"
                        id="apartment_{{$apartment->id}}" autocomplete="off" value="{{$apartment->id}}">
                    <label class="btn btn-outline-secondary list-group-item" for="apartment_{{$apartment->id}}">
                        <div class="d-md-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$apartment->number}}</h5>
                            <small class="fw-lighter d-block">{{$apartment->building->address}}</small>
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
                        <div class="row">
                            <span class="col-12 col-md-6">
                                {{$apartment->building_alias}}
                            </span>
                            <span class="col-12 col-md-6 fw-lighter">
                                {{$apartment->building->location}}
                            </span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        {{ $apartments->links() }}
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
