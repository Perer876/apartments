<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Termino de busqueda">
        </div>
        <div class="col-12 col-md-6 text-end">
            <div class="d-grid gap-2 d-md-block mb-4">
                @include('resources.contracts.components.sortby-dropdown')
                @include('resources.contracts.components.viewtype-radio')
            </div>
        </div>
    </div>
    @if ($contracts->count())
        @if ($this->viewIs('table'))
            <div class="card shadow-sm">
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sort('tenant_name')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Inquilino</span>
                                            <i class="{{ $this->sortIcon('tenant_name') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('apartment_number')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Número Dto.</span>
                                            <i class="{{ $this->sortIcon('apartment_number') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('amount_period')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Periodo</span>
                                            <i class="{{ $this->sortIcon('amount_period') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('monthly_rent')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Renta Mensual</span>
                                            <i class="{{ $this->sortIcon('monthly_rent') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('state')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Estado</span>
                                            <i class="{{ $this->sortIcon('state') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('start_at')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Comienzo</span>
                                            <i class="{{ $this->sortIcon('start_at') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('end_at')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Finalización</span>
                                            <i class="{{ $this->sortIcon('end_at') }}"></i>
                                        </div>
                                    </th>
                                    <th wire:click="sort('cancelled_at')" role="button" scope="col">
                                        <div class="d-flex w-100 justify-content-between">
                                            <span class="user-select-none me-1">Cancelado</span>
                                            <i class="{{ $this->sortIcon('cancelled_at') }}"></i>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts as $contract)
                                    <tr>
                                        <td>
                                            @can('view', $contract->tenant)
                                                <i class="bi bi-person"></i>
                                                <a 
                                                    href="{{route('tenants.show', [$contract->tenant])}}" 
                                                    class="link-secondary text-underline-hover">{{ $contract->tenant->name }}
                                                </a>
                                            @else
                                                {{ $contract->tenant->name }}
                                            @endcan
                                        </td>
                                        <td>
                                            <i class="bi bi-door-closed"></i>
                                            <a 
                                                href="{{route('apartments.show', [$contract->apartment])}}" 
                                                class="link-secondary text-underline-hover">{{ $contract->apartment->number }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($contract->amount == 1)
                                                {{ $contract->amount . ($contract->period == 'years' ? ' año' : ' mes')}}
                                            @else
                                                {{ $contract->amount . ($contract->period == 'years' ? ' años' : ' meses')}}
                                            @endif
                                        </td>
                                        <td>
                                            $ {{ $contract->monthly_rent }}
                                        </td>
                                        <td>
                                            @include('resources.contracts.components.status-show', ['contract' => $contract])
                                        </td>
                                        <td>{{ $contract->start_at->format('Y/m/d') }}</td>
                                        <td>{{ $contract->end_at->format('Y/m/d') }}</td>
                                        <td>{{ $contract->cancelled_at ? $contract->cancelled_at->format('Y/m/d') : '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif ($this->view == 'cards')
            <div class="row">
                @foreach ($contracts as $contract)
                    <div class="col-xl-6 col-md-8 col-sm-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light-{{ $this->stateColor[$contract->state]}}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h4 class="card-title m-0">
                                        <i class="bi bi-person-fill me-1"></i>
                                        <a 
                                            href="{{route('tenants.show', $contract->tenant)}}"
                                            class="link-secondary text-underline-hover">{{ $contract->tenant->name }}
                                        </a>
                                    </h4>
                                    <span class="fs-5">
                                        @include('resources.contracts.components.status-show', ['contract' => $contract])
                                    </span>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="d-flex w-100 justify-content-between">
                                        <div class="text-md-end mb-3">
                                            <p class="card-text fs-4 fw-lighter">
                                                ${{ $contract->monthly_rent }}
                                            </p>
                                        </div>
                                        <span class="card-text fs-5">
                                            <i class="bi bi-door-closed"></i>
                                            <a 
                                                href="{{route('apartments.show', [$contract->apartment])}}" 
                                                class="link-secondary text-underline-hover">{{ $contract->apartment->number }}
                                            </a>
                                        </span>
                                    </div>
                                    <h6 class="card-subtitle">Periodo</h6>
                                    <p class="card-text fs-5">
                                        @if($contract->amount == 1)
                                            {{ $contract->amount . ($contract->period == 'years' ? ' año' : ' mes')}}
                                        @else
                                            {{ $contract->amount . ($contract->period == 'years' ? ' años' : ' meses')}}
                                        @endif
                                    </p>
                                    <hr>
                                    <div class="d-md-flex w-100 justify-content-between">
                                        <div class="mb-3">
                                            <h6 class="card-subtitle">Comienzo</h6>
                                            <p class="card-text fs-5 fw-lighter">
                                                <small>{{ $contract->start_at->format('Y/m/d')}}</small>
                                            </p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="card-subtitle">Conclución</h6>
                                            <p class="card-text fs-5 fw-lighter">
                                                <small>{{ $contract->end_at->format('Y/m/d')}}</small>
                                            </p>
                                        </div>
                                        @if($contract->cancelled_at)
                                            <div class="mb-3">
                                                <h6 class="card-subtitle">Cancelado</h6>
                                                <p class="card-text fs-5 fw-lighter">
                                                    <small>{{ $contract->cancelled_at->format('Y/m/d')}}</small>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @else
        @if( strlen($this->search) == 0 )
            <div class="alert alert-light-info shadow-sm">
                <i class="bi-exclamation-circle-fill"></i> 
                No tienes contratos.
            </div>
        @else            
            <div class="alert alert-light-warning shadow-sm">
                <i class="bi-search"></i> 
                No se encontraron contratos con esa información.
            </div>
        @endif
    @endif
    <div class="text-center">
        {{ $contracts->links() }}
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
