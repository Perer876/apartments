<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="card-title">
                <i class="bi bi-images me-2"></i>
                Galeria de fotos
            </h5>
        </div>
        <div class="card-body">
            <div class="row gallery mb-3">
                @forelse ($apartment->images as $image)
                    <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-2">
                        <a href="#">
                            <img class="w-100 rounded active" src="{{asset('storage/'. $image->file_path)}}">
                        </a>
                    </div>
                @empty
                    <p class="card-text">Este departamento no tiene ninguna fotografia</p>
                @endforelse
            </div>
            <x-modal name="add-images-modal" type="primary" class="btn btn-outline-primary" size="lg">
                <x-slot name="trigger">
                    <i class="bi bi-plus"></i>
                    Agregar fotos
                </x-slot>
                <x-slot name="title">
                    <i class="bi bi-image-fill fs-5 me-2"></i>
                    Agregando fotografias al departamento
                </x-slot>
                <p class="card-text">Selecciona aquí las fotografias que desees agregar.</p>
                <div>
                    @livewire('apartments.select-photos', compact('apartment'))
                </div>
                <x-slot name="footer">
                    <x-modal.dismiss-button class="btn btn-light-secondary">
                        Cancelar
                    </x-modal.dismiss-button>
                    <button wire:click="$emit('saves')" class="btn btn-primary">
                        Guardar
                    </button>
                </x-slot>
            </x-modal>
        </div>
    </div>
    @push('stylesheets')
        @livewireStyles
    @endpush
    @push('scripts')
        @livewireScripts
        <script>
            Livewire.on('imagesValidated', () => {
                var myModalEl = document.getElementById('add-images-modal')
                var modal = bootstrap.Modal.getInstance(myModalEl)
                modal.hide();
            })
        </script>
    @endpush
</div>
