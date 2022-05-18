<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Nuevo contrato</h3>
                <p class="text-subtitle text-muted">Da click en el departamento que desea contratar el inquilino.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Contratos</x-breadcrumb.item>
                    <x-breadcrumb.item href="{{ $tenant->href }}">{{ $tenant->name }}</x-breadcrumb.item>
                    <x-breadcrumb.item>Nuevo contrato</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <form action="/contracts/tenants/{{$tenant->id}}" method="post">
            @csrf
            <section class="row justify-content-center">
                <div class="col-sm-12 col-md-8 col-xl-6">
                    <div class="card shadow-sm">
                        <div role="button" class="card-header bg-light-warning">
                            <h3 class="card-title user-select-none m-0">
                                <i class="bi bi-person-fill me-2"></i>
                                Inquilino
                            </h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <span class="card-text fs-4 fw-light">{{ $tenant->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-sm-12 col-md-8 col-xl-6">
                    <div class="card shadow-sm" x-data="{ open: true, toggle() { this.open = ! this.open } }">
                        <div role="button" class="card-header bg-light-warning" @click="toggle()">
                            <h3 class="card-title user-select-none m-0">
                                <i class="bi bi-door-closed-fill me-2"></i>
                                Selecionar departamento
                                <i x-show="!open" class="bi bi-chevron-down"></i>
                                <i x-show="open" class="bi bi-chevron-up"></i>
                            </h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body m-0">
                                <span class="card-text">Por favor, seleccione un departamento</span>
                            </div>
                            <div class="card-body" x-show="open" x-transition>
                                @livewire('contracts.select-apartment')
                            </div>
                            @error('apartment_id')
                                <div class="card-body m-0">
                                    <span class="badge bg-light-danger text-wrap">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-sm-12 col-md-8 col-xl-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light-warning">
                            <h3 class="card-title user-select-none m-0">
                                <i class="bi bi-clipboard-fill me-2"></i>
                                Contrato
                            </h3>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <x-forms.input 
                                    label="Fecha de inicio" 
                                    type="text" 
                                    name="start_at"
                                    placeholder="aaaa/mm/dd"
                                    autocomplete="off"
                                    value="{{now()->format('Y/m/d')}}"
                                >
                                    <x-slot name="datepicker"
                                        data-date-autoclose="true"    
                                        data-date-format="yyyy/mm/dd"
                                        data-date-today-highlight="true"
                                        data-date-start-date="0d"
                                        data-date-immediate-updates="true"
                                        data-date-title="Inicio"
                                    ></x-slot>
                                    <x-slot name="addonsRight">
                                        <x-forms.input.addon icon="bi-calendar-date"/>
                                    </x-slot>
                                </x-forms.input>

                                <div class="row" x-data="{
                                    amount: {{old('amount') ?? 1}}, 
                                    addOne() { this.amount += 1 }, 
                                    subtractOne() {  if(this.amount > 1) this.amount -= 1 } 
                                }">
                                    <x-forms.input 
                                        label="Cantidad"
                                        name="amount"
                                        type="number"
                                        value="1"
                                        size="4"
                                        class="form-control text-center"
                                        x-bind:value="amount"
                                    >
                                        <x-slot name="addonsLeft">
                                            <x-forms.input.addon>
                                                <i class="bi-dash-circle-fill" role="button" @click="subtractOne()"></i>
                                            </x-forms.input.addon>
                                        </x-slot>
                                        <x-slot name="addonsRight">
                                            <x-forms.input.addon>
                                                <i class="bi-plus-circle-fill" role="button" @click="addOne()"></i>
                                            </x-forms.input.addon>
                                        </x-slot>
                                    </x-forms.input>

                                    <div class="form-group col-md-8">
                                        <label for="period">Periodo</label>
                                        <div class="input-group">
                                            <select class="form-select" id="period" name="period">
                                                <option value="months">Meses</option>
                                                <option value="years">Años</option>
                                            </select>
                                            <span class="input-group-text">
                                                <span class="bi-clock-history"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning mt-2">Hacer contrato</button>
                                <a class="btn btn-secondary mt-2 ms-3" href="{{url()->previous()}}">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</x-base>