<div>
    <div class="mb-3">
        <input 
            class="form-control" 
            type="file" 
            multiple=""
            wire:model="images"
        >
        <div wire:loading wire:target="images" class="mt-3">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        @if ($errors->any())
            <ul class="mt-3">
                @foreach ($errors->all() as $error)
                    <li><span class="badge bg-light-danger text-wrap">{{ $error }}</span></li>
                @endforeach
            </ul>
        @else
            <div class="row gallery my-3">
                @foreach ($images as $image)
                    <div class="col-6 col-sm-6 col-lg-4 mt-2 mt-md-0 mb-2">
                        <a href="#">
                            <img class="w-100 border border-4 rounded active" src="{{ $image->temporaryUrl() }}">
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
