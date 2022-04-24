<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Departamentos</h3>
                <p class="text-subtitle text-muted">Aquí puedes administrar los diferentes departamentos que forman parte de tus edificios. </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    @isset ($building)
                        <x-breadcrumb.item href="{{route('buildings.index', [], false)}}">Edificios</x-breadcrumb.item>
                        <x-breadcrumb.item href="{{$building->href}}">{{$building->alias}}</x-breadcrumb.item>
                    @endisset
                    <x-breadcrumb.item>Departamentos</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    @include('partial.messages')
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                @livewire('apartments.index')
            </div>
        </section>
    </div>
</x-base>