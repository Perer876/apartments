<x-base>
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Inquilinos</h3>
                <p class="text-subtitle text-muted">Aquí puedes administrar tus inquilinos. </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Inquilinos</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                @livewire('tenants.index')
            </div>
        </section>
    </div>
    <x-slot name="styles">
        @livewireStyles
    </x-slot>
    <x-slot name="scripts">
        @livewireScripts
    </x-slot>
</x-base>