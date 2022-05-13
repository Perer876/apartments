<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Termino de busqueda">
        </div>
        <div class="col-12 col-md-6 text-end">
            <div class="d-grid gap-2 d-md-block mb-4">
                @include('resources.apartments.components.sortby-dropdown')
                @include('resources.apartments.components.viewtype-radio')
            </div>
        </div>
    </div>
    @if ($apartments->count())
        @if ($this->viewIs('table'))
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('building_alias')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Edificio</span>
                                            <i class="{{ $this->sortIcon('building_alias') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('number')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Número</span>
                                            <i class="{{ $this->sortIcon('number') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('floor')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Piso</span>
                                            <i class="{{ $this->sortIcon('floor') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('garages')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Cocheras</span>
                                            <i class="{{ $this->sortIcon('garages') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('bathrooms')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Baños</span>
                                            <i class="{{ $this->sortIcon('bathrooms') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('bedrooms')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Dormitorios</span>
                                            <i class="{{ $this->sortIcon('bedrooms') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('monthly_rent')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="me-1">Renta mensual</span>
                                            <i class="{{ $this->sortIcon('monthly_rent') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apartments as $apartment)
                                    <tr>
                                        <td>
                                            <a href="/buildings/{{$apartment->building_id }}" class="link-secondary text-underline-hover">
                                                {{$apartment->building_alias}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $apartment->href }}" class="link-secondary text-underline-hover">
                                                {{$apartment->number}}
                                            </a>
                                        </td>
                                        <td>{{$apartment->floor}}</td>
                                        <td>{{$apartment->garages}}</td>
                                        <td>{{$apartment->bathrooms}}</td>
                                        <td>{{$apartment->bedrooms}}</td>
                                        <td>$ {{$apartment->monthly_rent}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif ($this->view == 'list')
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10 col-xl-8">
                    <div class="card shadow-sm">
                        <div class="card-content">
                            <div class="card-body">
                                <h4 class="card-title text-center fs-3">Lista de departamentos</h4>
                                <hr>
                                @include('resources.apartments.views.list', compact('apartments'))
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if( strlen($this->search) == 0 )
            <div class="alert alert-light-info shadow-sm">
                <i class="bi-exclamation-circle-fill"></i> 
                No tienes departamentos.
            </div>
        @else            
            <div class="alert alert-light-warning shadow-sm">
                <i class="bi-search"></i> 
                No se encontraron departamentos con esa información.
            </div>
        @endif
    @endif
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
