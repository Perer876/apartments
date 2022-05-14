<div>
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <input type="text" wire:model="search" class="form-control" placeholder="Buscar departamento">
        </div>
        <div class="col-12 col-md-6">
            <div class="d-grid gap-2 d-block mb-4">
                @include('resources.apartments.components.sortby-dropdown')
            </div>
        </div>
        <div class="col-12">
            <div class="d-grid gap-2">
                <div class="btn-group-vertical" role="group" aria-label="Select apartment">
                @foreach ($apartments as $apartment)
                    <input type="radio" class="btn-check" name="apartment_id"
                        id="apartment_{{$apartment->id}}" autocomplete="off" value="{{$apartment->id}}">
                    <label class="btn btn-outline-secondary list-group-item" for="apartment_{{$apartment->id}}">
                        @include('resources.apartments.components.list-item-show', [
                            'apartment' => $apartment,
                            'hide' => ['contract']
                        ])
                    </label>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        {{ $apartments->links() }}
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
    @endpush
</div>
