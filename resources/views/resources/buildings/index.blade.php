<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edificios</h3>
                @role('lessor')
                    <p class="text-subtitle text-muted">Aquí puedes administrar los diferentes edificios departamentales de los cuales quieras llevar el control. </p>
                @else
                    <p class="text-subtitle text-muted">Mira los edificios que se encuentran en nuestro sitio.</p>
                @endrole
                </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item>Edificios</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                @livewire('buildings.index')
            </div>
        </section>
    </div>
</x-base>