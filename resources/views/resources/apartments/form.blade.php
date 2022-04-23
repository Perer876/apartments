<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                @isset($apartment)
                <h3>Editar departamento</h3>
                <p class="text-subtitle text-muted">Modifica los campos que desees cambiar.</p>
                @else
                <h3>Agregar departamento</h3>
                <p class="text-subtitle text-muted">Indica los datos del nuevo departamento.</p>
                @endisset
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings">Edificios</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings/{{$building->id}}">{{$building->alias}}</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings/{{$building->id}}/apartments">Departamentos</x-breadcrumb.item>
                    @isset($apartment)
                    <x-breadcrumb.item href="/apartments/{{$apartment->id}}">{{$apartment->number}}</x-breadcrumb.item>
                    <x-breadcrumb.item>Editar</x-breadcrumb.item>
                    @else
                    <x-breadcrumb.item>Nuevo departamento</x-breadcrumb.item>
                    @endisset
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light-primary">
                        <h4 class="card-title">
                            @isset($apartment)
                            Formulario editar departamento
                            @else
                            Formulario nuevo departamento
                            @endisset
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        @isset($apartment)
                            <form action="/apartments/{{$apartment->id}}" method="post">
                            @method('PATCH')
                        @else
                            <form action="/buildings/{{$building->id}}/apartments" method="post">
                        @endisset
                                @csrf
                                <x-forms.input 
                                    label="Número" 
                                    name="number" 
                                    type="text" 
                                    placeholder="Denominación o identificador" 
                                    value="{{$building->number}}-"
                                    horizontal-form
                                    :object="isset($apartment) ? $apartment : null" 
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi bi-door-closed" />
                                    </x-slot>
                                </x-forms.input>

                                <x-forms.input 
                                    label="Piso" 
                                    name="floor" 
                                    type="number" 
                                    placeholder="Número de piso" 
                                    horizontal-form
                                    :object="isset($apartment) ? $apartment : null" 
                                ></x-forms.input>

                                <x-forms.input 
                                    label="Cocheras" 
                                    name="garages" 
                                    type="number" 
                                    placeholder="Cantidad de cocheras" 
                                    horizontal-form
                                    :object="isset($apartment) ? $apartment : null" 
                                ></x-forms.input>

                                <x-forms.input 
                                    label="Baños" 
                                    name="bathrooms" 
                                    type="number" 
                                    placeholder="Cantidad de baños" 
                                    horizontal-form
                                    :object="isset($apartment) ? $apartment : null" 
                                ></x-forms.input>

                                <x-forms.input 
                                    label="Dormitorios" 
                                    name="bedrooms" 
                                    type="number" 
                                    placeholder="Cantidad de dormitorios" 
                                    horizontal-form
                                    :object="isset($apartment) ? $apartment : null" 
                                ></x-forms.input>

                                <x-forms.input 
                                    label="Renta mensual" 
                                    name="monthly_rent" 
                                    type="number" 
                                    step="any" 
                                    placeholder="0.00" 
                                    horizontal-form
                                    :object="isset($apartment) ? $apartment : null" 
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon>$</x-forms.input.addon>
                                    </x-slot>
                                </x-forms.input>

                                <div class="d-grid gap-2 d-sm-block my-3 text-end">
                                    <button type="submit" class="btn btn-primary ms-sm-2">Guardar</button>
                                    @isset ($apartment)
                                        <a class="btn btn-light-secondary ms-sm-2" href="/apartments/{{$apartment->id}}">Regresar</a>
                                    @else
                                        <a class="btn btn-light-secondary ms-sm-2" href="/buildings/{{$building->id}}">Cancelar</a>
                                    @endisset
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> 
</x-base>