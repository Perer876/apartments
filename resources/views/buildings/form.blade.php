<x-base>
    <div class="page-heading">
        @isset($building)
        <h3>Editar edificio</h3>
        <p class="text-subtitle text-muted">Modifica los campos que desees cambiar.</p>
        @else
        <h3>Agregar edificio</h3>
        <p class="text-subtitle text-muted">Indica los datos del nuevo edificio..</p>
        @endisset
    </div>
    <div class="page-content">
        <section class="row justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            @isset($building)
                            Formulario editar edificio
                            @else
                            Formulario nuevo edificio
                            @endisset
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        @isset($building)
                            <form action="/buildings/{{$building->id}}" method="post">
                            @method('PATCH')
                        @else
                            <form action="/buildings" method="post">
                        @endisset
                                @csrf
                                <x-forms.input 
                                    label="Alias" 
                                    name="alias" 
                                    type="text" 
                                    placeholder="Nombre representativo" 
                                    :object="isset($building) ? $building : null" 
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi bi-house" />
                                    </x-slot>
                                </x-forms.input>

                                <div class="row">
                                    <x-forms.input 
                                        label="Calle"
                                        name="street"
                                        type="text"
                                        placeholder="Calle"
                                        :object="isset($building) ? $building : null"
                                        size=8
                                    />
                                    
                                    <x-forms.input 
                                        label="Número"
                                        name="number"
                                        type="number"
                                        :object="isset($building) ? $building : null"
                                        size=4
                                    >
                                        <x-slot name="addonsLeft">
                                            <x-forms.input.addon>#</x-forms.input.addon>
                                        </x-slot>
                                    </x-forms.input>
                                </div>

                                <x-forms.input 
                                    label="Municipio"
                                    name="city"
                                    type="text"
                                    placeholder="Nombre municipio"
                                    :object="isset($building) ? $building : null"
                                />

                                <x-forms.input 
                                    label="Estado"
                                    name="state"
                                    type="text"
                                    placeholder="Estado"
                                    :object="isset($building) ? $building : null"
                                />

                                <div class="row">
                                    <x-forms.input 
                                        label="Código postal"
                                        name="postcode"
                                        type="number"
                                        placeholder="00000"
                                        :object="isset($building) ? $building : null"
                                        size="6"
                                    />

                                    <x-forms.input 
                                        label="Año"
                                        name="builded_at"
                                        type="number"
                                        placeholder="Año de construcción"
                                        :object="isset($building) ? $building : null"
                                        size="6"
                                    >
                                        <x-slot name="addonsRight">
                                            <x-forms.input.addon icon="bi bi-calendar-event" />
                                        </x-slot>
                                    </x-forms.input>
                                </div>

                                <div class="col-sm-12 mt-3 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary ms-3">Guardar</button>
                                    @isset ($building)
                                        <a class="btn btn-light-secondary ms-3" href="/buildings/{{$building->id}}">Regresar</a>
                                    @else
                                        <a class="btn btn-light-secondary ms-3" href="/buildings">Cancelar</a>
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