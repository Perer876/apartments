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
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">{{ $close }}</span>
                    </button>
                    <a href="{{ $href }}" class="btn btn-{{$type}}">{{ $accept }}</a>
                </div>
            </div>
        </div>
    </div>
</div>