<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                @isset($tenant)
                    <h3>Actualizar información del inquilino</h3>
                    <p class="text-subtitle text-muted">Modifica los campos que desees actualizar.</p>
                @else
                    <h3>Agregar nuevo inquilino</h3>
                    <p class="text-subtitle text-muted">Indica los datos del nuevo inquilino.</p>
                @endisset
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/tenants">Inquilinos</x-breadcrumb.item>
                    <x-breadcrumb.item>Nuevo Inquilino</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                @livewire('tenants.form')
            </div>
        </section>
    </div>
</x-base>
