<div class="modal-{{$type}} me-1 mb-1 d-inline-block">
    <!-- Button trigger for danger theme modal -->
    <button type="button" class="btn btn-{{$type}}" data-bs-toggle="modal" data-bs-target="#m-{{$uuid}}">
        Eliminar
    </button>

    <!--Danger theme Modal -->
    <div class="modal fade text-left" id="m-{{$uuid}}" tabindex="-1" aria-labelledby="ml-{{$uuid}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-{{$type}}">
                    <h5 class="modal-title white" id="ml-{{$uuid}}">
                        {{ $title }}
                    </h5>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>