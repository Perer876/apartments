<div>
    <div class="row">
        <div class="col-12 col-md-4 order-md-1">
            <h5>
                {{ __('Addresses') }}
            </h5>
            <p class="text-subtitle text-muted">
                {{ __('Address list where your tenants can pay you the rent.') }}
            </p>
        </div>
        <div class="col-12 col-md-8 order-md-2">
            <div class="card shadow-sm m-0">
                <div class="card-content">
                    <div class="card-body">
                        <ul class="list-group">
                        @forelse (Auth::user()->addresses as $address)
                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="fw-bolder">{{$address->street}}, {{$address->building_number}}</span>
                                        <br>
                                        @if($address->apartment_number)
                                            APT. {{$address->apartment_number}}
                                            <br>
                                        @endif
                                        {{$address->city}}, {{$address->state}}
                                        <br>
                                        <small class="fw-lighter"> C.P. {{$address->postcode}}</small>
                                    </div>
                                    <div class="col text-end">
                                        @if($address->active)
                                            <button class="btn btn-success">En uso</button>
                                        @else
                                            <button class="btn btn-outline-success">Usar</button>
                                        @endif
                                        <button class="btn btn-outline-warning ms-1">Editar</button>
                                        <button class="btn btn-outline-danger ms-1">Eliminar</button>
                                    </div>
                                </div>
                            </li>
                        @empty
                            {{ __('You don\'n have any addresses.') }}
                        @endforelse
                        </ul>
                        <br>
                        <a type="button" class="btn btn-primary" href="">
                            {{ __('Add new address') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
