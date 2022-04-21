<x-base>
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                @isset($building)
                <h3>Editar edificio</h3>
                <p class="text-subtitle text-muted">Modifica los campos que desees cambiar.</p>
                @else
                <h3>Agregar edificio</h3>
                <p class="text-subtitle text-muted">Indica los datos del nuevo edificio.</p>
                @endisset
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/buildings">Edificios</x-breadcrumb.item>
                    @isset($building)
                    <x-breadcrumb.item href="/buildings/{{$building->id}}">{{$building->alias}}</x-breadcrumb.item>
                    <x-breadcrumb.item>Editar</x-breadcrumb.item>
                    @else
                    <x-breadcrumb.item>Nuevo edificio</x-breadcrumb.item>
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
                                        placeholder="Número"
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
                                <div class="d-grid gap-2 d-sm-block my-3 text-end">
                                    <button type="submit" class="btn btn-primary ms-sm-2">Guardar</button>
                                    @isset ($building)
                                        <a class="btn btn-light-secondary ms-sm-2" href="/buildings/{{$building->id}}">Regresar</a>
                                    @else
                                        <a class="btn btn-light-secondary ms-sm-2" href="/buildings">Cancelar</a>
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