<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <h3>Bienvenido a Depadmin</h3>
        <p class="text-subtitle text-muted">Ten un resumen de tus actividades relacionadas a tus departamentos.</p>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('buildings.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body px-2">
                            <div class="row text-center text-md-start">
                                <div class="col-md-4">
                                    <div class="stats-icon purple float-none float-md-end d-inline-block text-center">
                                        <i class="bi-house-fill fs-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Edificios</h6>
                                    <h6 class="font-extrabold mb-0 fs-5">{{ $buildings_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('apartments.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body px-2">
                            <div class="row text-center text-md-start">
                                <div class="col-md-4">
                                    <div class="stats-icon blue float-none float-md-end d-inline-block text-center">
                                        <i class="bi-door-closed-fill fs-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Departamentos</h6>
                                    <h6 class="font-extrabold mb-0 fs-5">{{ $apartments_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('tenants.index') }}">
                    <div class="card shadow-sm">
                        <div class="card-body px-2">
                            <div class="row text-center text-md-start">
                                <div class="col-md-4">
                                    <div class="stats-icon green float-none float-md-end d-inline-block text-center">
                                        <i class="bi-people-fill fs-2"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Inquilinos</h6>
                                    <h6 class="font-extrabold mb-0 fs-5">{{ $tenants_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body px-2">
                        <div class="row text-center text-md-start">
                            <div class="col-md-4">
                                <div class="stats-icon red float-none float-md-end d-inline-block text-center">
                                    <i class="bi-clipboard-check-fill fs-2"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold">Contratos</h6>
                                <h6 class="font-extrabold mb-0 fs-5">{{ $contracts_count }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>