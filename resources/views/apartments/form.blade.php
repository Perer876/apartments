<x-base>
    <div class="page-heading">
        @isset($apartment)
        <h3>Editar departamento</h3>
        <p class="text-subtitle text-muted">Modifica los campos que desees cambiar.</p>
        @else
        <h3>Agregar departamento</h3>
        <p class="text-subtitle text-muted">Indica los datos del nuevo departamento.</p>
        @endisset
    </div>
    <div class="page-content">
        <section class="row justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
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

                                <div class="col-sm-12 mt-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary ms-3">Guardar</button>
                                    @isset ($apartment)
                                        <a class="btn btn-light-secondary ms-3" href="/apartments/{{$apartment->id}}">Regresar</a>
                                    @else
                                        <a class="btn btn-light-secondary ms-3" href="/buildings/{{$building->id}}">Cancelar</a>
                                    @endisset
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div> 
    <x-slot name="stylesheets">
        <link rel="stylesheet" href="{{asset('assets/vendors/fontawesome/all.min.css')}}">
    </x-slot>
</x-base>