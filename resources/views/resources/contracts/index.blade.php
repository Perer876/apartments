<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Contratos</h3>
                <p class="text-subtitle text-muted">
                    Aquí puedes ver los contratos que tengas o hayas tenido anteriormente. Para agregar un nuevo contrato, dirigite a un
                    <a href="{{route('tenants.index')}}" class="link-info">inquilino</a>.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{ route('home') }}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Contratos</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        @livewire('contracts.index')
    </div>
</x-base>