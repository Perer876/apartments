<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Inquilinos archivados</h3>
                <p class="text-subtitle text-muted">Estos son los inquilinos que has archivado.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="{{route('tenants.index')}}">Inquilinos</x-breadcrumb.item>
                    <x-breadcrumb.item>Archivo</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-xl-8">
                @include('partial.messages')
                <div class="card shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title text-center fs-3">Archivo</h4>
                            <hr>
                            <ul class="list-group">
                                @forelse ($tenants as $tenant)
                                    <li class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <span class="fs-4 mt-1">
                                                <i class="bi bi-person"></i>
                                                {{$tenant->name}}
                                            </span>
                                            <div class="d-flex justify-content-end align-items-center">
                                            <form action="{{route('tenants.restore', $tenant)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-outline-success me-3">
                                                    Restaurar
                                                </button>
                                            </form>
                                            <span>
                                            @can('delete', $tenant)
                                                <x-modal name="confirm-delete-{{$tenant->id}}" type="danger" class="btn btn-outline-danger">
                                                    <x-slot name="trigger">
                                                        <i class="bi bi-trash"></i>
                                                        Eliminar
                                                    </x-slot>
                                                    <x-slot name="title">
                                                        Eliminar a {{$tenant->name}}
                                                    </x-slot>
                                                    ¿Estas seguro que quieres eliminar este inquilino? Se borraran también los contratos que tengas registrados que esten relacionados con este inquilino.
                                                    <x-slot name="footer">
                                                        <x-modal.dismiss-button class="btn btn-light-secondary">
                                                            Cancelar
                                                        </x-modal.dismiss-button>
                                                        <form action="{{route('tenants.destroy', $tenant)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                Confirmar
                                                            </button>
                                                        </form>
                                                    </x-slot>
                                                </x-modal>
                                            @endcan
                                            </span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <div class="alert alert-light-info shadow-sm">
                                        <i class="bi-exclamation-circle-fill"></i> 
                                        No tienes inquilinos archivados.
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>