<x-base>
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Inquilino - {{ $tenant->name }}</h3>
                <p class="text-subtitle text-muted">Mostrando detalle.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/tenants">Inquilinos</x-breadcrumb.item>
                    <x-breadcrumb.item>{{$tenant->name}}</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    @include('partial.sidebar')
    <div class="page-content">
        <section class="row">
            @include('partial.messages')
            <div class="col-md-6 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Detalles</h4>
                            <hr>
                            <h6 class="card-subtitle">Nombre</h6>
                            <p class="card-text">{{ $tenant->name }}</p>
                            <h6 class="card-subtitle">Número de teléfono</h6>
                            <p class="card-text">{{ $tenant->phone }}</p>
                            <h6 class="card-subtitle">Edad</h6>
                            <p class="card-text">{{ $tenant->age }}</p>
                            <div class="buttons text-center">
                                <a href="/buildings/{{$tenant->id}}/edit" class="btn btn-outline-warning">Editar</a>
                                <x-modal name="confirm-delete" type="danger" class="btn btn-outline-danger">
                                    <x-slot name="title">
                                        Eliminar inquilino
                                    </x-slot>
                                    ¿Estas seguro que quieres eliminar este inquilino? Se borraran también los contratos que tengas registrados que esten relacionados con este inquilino.
                                    <x-slot name="footer">
                                        <x-modal.dismiss-button class="btn btn-light-secondary">
                                            Cancelar
                                        </x-modal.dismiss-button>
                                        <form action="/tenants/{{$tenant->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Eliminar">
                                        </form>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted d-flex justify-content-end">
                            Creado el {{ $tenant->created_at->format('d/m/Y') }} a las {{ $tenant->created_at->format('H:i') }}
                        </small>
                        <small class="text-muted d-flex justify-content-end">
                            Actualizado el {{ $tenant->updated_at->format('d/m/Y') }} a las {{ $tenant->updated_at->format('H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>