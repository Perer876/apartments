<x-base>
    @include('partial.sidebar')
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
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                @include('partial.messages')
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <!-- Tenant details -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="bi-person me-2"></i>
                                        Detalles
                                    </h4>
                                    <hr>
                                    <h6 class="card-subtitle">Nombre</h6>
                                    <p class="card-text">{{ $tenant->name }}</p>
                                    <h6 class="card-subtitle">Número de teléfono</h6>
                                    @if($tenant->phone)
                                        <p class="card-text">{{ $tenant->phone }}</p>
                                    @else
                                        <p class="badge bg-light-danger">No registrado</p>
                                    @endif
                                    <h6 class="card-subtitle">Edad</h6>
                                    @if($tenant->birthday)
                                        <p class="card-text">{{$tenant->age}}</p>
                                    @else
                                        <p class="badge bg-light-danger">Desconocida</p>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-md-flex w-100 justify-content-between">
                                    <div class="buttons text-center text-md-left">
                                        <a href="/tenants/{{$tenant->id}}/edit" class="btn btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                            Editar
                                        </a>
                                        <x-modal name="confirm-delete" type="danger" class="btn btn-outline-danger">
                                            <x-slot name="trigger">
                                                <i class="bi bi-trash"></i>
                                                Eliminar
                                            </x-slot>
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
                                                    <button type="submit" class="btn btn-danger">
                                                        Confirmar
                                                    </button>
                                                </form>
                                            </x-slot>
                                        </x-modal>
                                    </div>
                                    <div>
                                        <small class="text-muted d-flex justify-content-end">
                                            Creado el {{ $tenant->created_at->format('d/m/Y') }} a las {{ $tenant->created_at->format('H:i') }}
                                        </small>
                                        <small class="text-muted d-flex justify-content-end">
                                            Actualizado el {{ $tenant->updated_at->format('d/m/Y') }} a las {{ $tenant->updated_at->format('H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <!-- Contracts with the tenant -->
                    <div class="col-12">
                        <div class="card shadow-sm mb-4">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="bi bi-clipboard me-2"></i>
                                        Contrato
                                    </h4>
                                    <hr>
                                    
                                    <a class="btn btn-outline-info" href="/contracts/tenants/{{$tenant->id}}/create">Generar contrato</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User related with tenant -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="bi bi-envelope me-2"></i>
                                        Usuario
                                    </h4>
                                    <hr>
                                    @if(!$tenant->user)
                                        <p class="card-text">
                                            Este inquilino todavía no tiene una cuenta a la cual este relacionado.
                                        </p>
                                        @if ($tenant->registration_tokens()->first())
                                            <h6 class="card-subtitle">Invitaciones</h6>
                                            <ul class="list-group my-2">
                                                @foreach ($tenant->registration_tokens()->latest()->get() as $invitation)
                                                    <li class="list-group-item">   
                                                        <small>Ya se ha enviado una invitación al correo: </small>
                                                        <br>
                                                        @if ($invitation->is_expired)
                                                            <div class="text-center">
                                                                <span class="badge bg-light-danger">{{$invitation->email}}</span>
                                                            </div>
                                                            Expiró el {{$invitation->expires_at->format('Y/m/d')}}.
                                                            Por favor vuelva a enviar una nueva invitación.
                                                        @else
                                                            <div class="text-center">
                                                                <span class="badge bg-light-success">{{$invitation->email}}</span>
                                                            </div>
                                                            Valida hasta el {{$invitation->expires_at->format('Y/m/d')}}.
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        <a class="btn btn-outline-primary" href="/tenants/{{$tenant->id}}/invite">Invitar</a>
                                    @else
                                        <p class="card-text">
                                            Este inquilino ya tiene una cuenta de usuario asociada.
                                        </p>
                                        <hr>
                                        <h6 class="card-subtitle">Correo</h6>
                                        <p class="card-text fw-light">{{$tenant->user->email}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>    
</x-base>