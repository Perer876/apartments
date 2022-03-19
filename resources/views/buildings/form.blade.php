<x-base>
    <div class="page-heading">
        <h3>Agregar edificio</h3>
        <p class="text-subtitle text-muted">Indica los datos del nuevo edificio.</p>
    </div>
    <div class="page-content">
        <section class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Formulario nuevo edificio</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" action="/buildings" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <x-forms.input 
                                            label="Alias"
                                            name="alias"
                                            type="text"
                                            placeholder="Nombre representativo"
                                        />

                                        <x-forms.input 
                                            label="Calle"
                                            name="street"
                                            type="text"
                                            placeholder="Calle"
                                        />

                                        <x-forms.input 
                                            label="Número"
                                            name="number"
                                            type="number"
                                            placeholder="Número"
                                        />
                                        
                                        <x-forms.input 
                                            label="Código postal"
                                            name="postcode"
                                            type="number"
                                            placeholder="00000"
                                        />

                                        <x-forms.input 
                                            label="Municipio"
                                            name="city"
                                            type="text"
                                            placeholder="Nombre municipio"
                                        />

                                        <x-forms.input 
                                            label="Estado"
                                            name="state"
                                            type="text"
                                            placeholder="Estado"
                                        />

                                        <x-forms.input 
                                            label="Año"
                                            name="builded_at"
                                            type="number"
                                            placeholder="Año de construcción"
                                        />

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Guardar</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Limpiar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>