<!-- Button trigger for modal -->
<button type="button" class="{{ $attributes['class'] ?? 'btn btn-'.$type }}" data-bs-toggle="modal" data-bs-target="#m-{{$type}}-{{$name}}">
    {{ isset($trigger) ? $trigger : 'Eliminar'}}
</button>

<div class="modal fade text-left" id="m-{{$type}}-{{$name}}" tabindex="-1" aria-labelledby="ml-{{$type}}-{{$name}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-{{$type}}">
                <h5 class="modal-title white" id="ml-{{$type}}-{{$name}}">
                    {{ $title }}
                </h5>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>