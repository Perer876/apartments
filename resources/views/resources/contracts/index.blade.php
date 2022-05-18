<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Contratos</h3>
                <p class="text-subtitle text-muted">
                    @can('contracts.create')
                        Aquí puedes ver los contratos que tengas o hayas tenido anteriormente. Para agregar un nuevo contrato, dirigite a un
                        <a href="{{route('tenants.index')}}" class="link-info">inquilino</a>.
                    @else
                        Aquí puedes ver los contratos que tengas en cativcon tus arrendadores.
                    @endcan
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
        <div class="row">
            <div class="col-12">
                @include('partial.messages')
            </div>
        </div>
        @livewire('contracts.index')
    </div>
</x-base>