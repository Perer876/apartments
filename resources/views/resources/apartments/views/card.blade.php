@forelse ($apartments as $apartment)
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>
                    <i class="bi bi-door-closed"></i>
                    <a href="{{$apartment->href}}" class="link-secondary text-underline-hover">{{$apartment->number}}</a>
                </h4>
                <span class="fw-bolder">{{$apartment->building->address}}</span>
                <br>
                {{$apartment->building->location}}
            </div>
            @if($apartment->images->count() > 0)
                <div id="carouselApartent{{$apartment->id}}Images" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($apartment->images as $key => $image)
                            <div class="carousel-item{{$key === 0 ? ' active' : null}}" data-bs-interval="5000">
                                <img src="{{asset('storage/'. $image->file_path)}}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    @if($apartment->images->count() > 1)
                        <a class="carousel-control-prev" href="#carouselApartent{{$apartment->id}}Images" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselApartent{{$apartment->id}}Images" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    @endif
                </div>
            @endif
            <div class="card-body">
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
            </div>
            <div class="card-footer bg-light-success">
                <div class="text-center fs-3">
                    <i class="bi bi-currency-dollar"></i>
                    {{$apartment->monthly_rent}}
                </div>
            </div>
        </div>
    </div>
@empty
    
@endforelse