<x-modal name="confirm-cancel-contract-{{$tenant->id}}" type="danger" class="btn btn-outline-danger">
    <x-slot name="trigger">
        Cancelar contrato
    </x-slot>
    <x-slot name="title">
        Cancelar contrato
    </x-slot>
    ¿Estás seguro de que quieres cancelar el contrato activo con <span class="fw-bold">{{$tenant->name}}</span>? 
    <x-slot name="footer">
        <x-modal.dismiss-button class="btn btn-light-secondary">
            Cancelar
        </x-modal.dismiss-button>
        <form action="/contracts/{{$tenant->lastestContract->id}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                Confirmar
            </button>
        </form>
    </x-slot>
</x-modal>