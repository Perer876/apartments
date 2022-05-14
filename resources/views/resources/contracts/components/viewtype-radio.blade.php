<div class="btn-group mb-md-2 ms-md-2" role="group" aria-label="View type check group">
    <input type="radio" wire:click="view('table')" class="btn-check" name="view-type-options"
        id="table-view" autocomplete="off" {{ $this->viewIs('table', ' checked') }}>
    <label class="btn btn-outline-warning" for="table-view">Tabla</label>
    <input type="radio" wire:click="view('cards')" class="btn-check" name="view-type-options"
        id="card-view" autocomplete="off" {{ $this->viewIs('cards', ' checked') }}>
    <label class="btn btn-outline-warning" for="card-view">Tarjetas</label>
</div>