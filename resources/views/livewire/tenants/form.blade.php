<div>
    <div class="card shadow-sm">
        @if($tenant->id)
            <div class="card-header bg-light-success">
                <h4 class="card-title">
                    Formulario actualizar datos
                </h4>
            </div>
        @else
            <div class="card-header bg-light-primary">
                <h4 class="card-title">
                    Formulario nuevo inquilino
                </h4>
            </div>
        @endif
        <div class="card-content">
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="row">
                        <x-forms.input 
                            label="Nombre" 
                            type="text" 
                            wire:model.debounce.900ms="tenant.first_name"
                            placeholder="Nombre"
                            validate="{{$this->showValidate('tenant.first_name') ?? null}}"
                            size=6
                            autocomplete="off"
                        />
                        <x-forms.input 
                            label="Apellido" 
                            type="text" 
                            wire:model.debounce.900ms="tenant.last_name"
                            placeholder="Apellido"
                            validate="{{$this->showValidate('tenant.last_name') ?? null}}"
                            size=6
                            autocomplete="off"
                        />
                    </div>
                    <x-forms.input 
                        label="Telefono" 
                        type="tel" 
                        wire:model.debounce.900ms="tenant.phone"
                        placeholder="Telefono"
                        validate="{{$this->showValidate('tenant.phone') ?? null}}"
                        autocomplete="off"
                    >
                        <x-slot name="addonsRight">
                            <x-forms.input.addon icon="bi bi-telephone-plus" />
                        </x-slot>
                    </x-forms.input>
                    
                    <x-forms.input 
                        label="Fecha de nacimiento" 
                        type="text" 
                        wire:model.debounce.900ms="tenant.birthday"
                        placeholder="Fecha"
                        validate="{{$this->showValidate('tenant.birthday') ?? null}}"
                        autocomplete="off"
                    >
                        <x-slot name="datepicker"
                            data-date-autoclose="true"    
                            data-date-format="yyyy/mm/dd"
                            data-date-today-highlight="true"
                            data-date-end-date="0d"
                            data-date-immediate-updates="true"
                            data-date-title="Fecha de nacimiento"
                        ></x-slot>
                        <x-slot name="addonsRight">
                            <x-forms.input.addon icon="bi bi-calendar-date"/>
                        </x-slot>
                    </x-forms.input>

                    <div class="d-grid gap-2 d-sm-block my-3 text-end">
                        @if($tenant->id)
                            <button type="submit" class="btn btn-primary ms-sm-2">Actualizar datos</button>
                            <a class="btn btn-light-secondary ms-sm-2" href="{{$tenant->href}}">Cancelar</a>
                        @else
                            <button type="submit" class="btn btn-primary ms-sm-2">Agregar</button>
                            <a class="btn btn-light-secondary ms-sm-2" href="/tenants">Cancelar</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
