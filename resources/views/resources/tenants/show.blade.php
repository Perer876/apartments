<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Inquilino</h3>
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
                        <div class="card shadow-sm mb-4">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="bi bi-person me-2"></i>
                                        Nombre
                                    </h4>
                                    <p class="card-text text-md-start fs-4">
                                        {{ $tenant->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-content">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="bi-card-text me-2"></i>
                                        Detalles
                                    </h4>
                                    <hr>
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
                                        @can('update', $tenant)
                                            <a href="/tenants/{{$tenant->id}}/edit" class="btn btn-outline-warning">
                                                <i class="bi bi-pencil"></i>
                                                Editar
                                            </a>
                                        @endcan
                                        @can('archive', $tenant)
                                            <x-modal name="confirm-delete" type="info" class="btn btn-outline-info">
                                                <x-slot name="trigger">
                                                    <i class="bi bi-archive"></i>
                                                    Archivar
                                                </x-slot>
                                                <x-slot name="title">
                                                    Archivar inquilino
                                                </x-slot>
                                                Archivarlo no hara que se borren sus contratos, solo se ocultará de la lista ¿Deseas continuar?
                                                <x-slot name="footer">
                                                    <x-modal.dismiss-button class="btn btn-light-secondary">
                                                        Cancelar
                                                    </x-modal.dismiss-button>
                                                    <form action="{{route('tenants.archive', $tenant)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-info">
                                                            Confirmar
                                                        </button>
                                                    </form>
                                                </x-slot>
                                            </x-modal>
                                        @endcan
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
                                    @if( $tenant->lastestContract )
                                        <div class="d-md-flex w-100 justify-content-between">
                                            <div class="mb-3">
                                                <h6 class="card-subtitle">
                                                    Departamento
                                                </h6>
                                                <p class="card-text fs-3 fw-lighter">
                                                    <i class="bi bi-door-closed"></i>
                                                    <a href="/apartments/{{$tenant->lastestContract->apartment->id}}" class="link-secondary text-underline-hover">
                                                        {{ $tenant->lastestContract->apartment->number }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-md-flex w-100 justify-content-between">
                                            <div class="mb-3">
                                                <h6 class="card-subtitle">Estatus</h6>
                                                <p class="card-text fs-5">
                                                    @include('resources.contracts.components.status-show', ['contract' => $tenant->lastestContract])
                                                </p>
                                            </div>
                                            <div class="text-md-end mb-3">
                                                <h6 class="card-subtitle">Renta mensual</h6>
                                                <p class="card-text fs-4">
                                                    <span class="badge bg-light-info">
                                                        ${{ $tenant->lastestContract->monthly_rent }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-md-flex w-100 justify-content-between">
                                            <div class="mb-3">
                                                <h6 class="card-subtitle">Comienzo</h6>
                                                <p class="card-text fs-5 fw-lighter">
                                                    <span>{{ $tenant->lastestContract->start_at->format('Y/m/d')}}</span>
                                                </p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="card-subtitle">Conclución</h6>
                                                <p class="card-text fs-5 fw-lighter">
                                                    <span>{{ $tenant->lastestContract->end_at->format('Y/m/d')}}</span>
                                                </p>
                                            </div>
                                            @if($tenant->lastestContract->cancelled_at)
                                                <div class="mb-3">
                                                    <h6 class="card-subtitle">Cancelado</h6>
                                                    <p class="card-text fs-5 fw-lighter">
                                                        <span>{{ $tenant->lastestContract->cancelled_at->format('Y/m/d')}}</span>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($tenant->lastestContract->isActive || $tenant->lastestContract->isComing)
                                            @include('resources.contracts.components.cancel-modal', compact('tenant'))
                                        @else
                                            <a class="btn btn-outline-info" href="/contracts/tenants/{{$tenant->id}}/create">Nuevo contrato</a>
                                        @endif
                                    @else
                                        <p class="card-text">
                                            No tiene ningún contrato contigo.
                                        </p>
                                        <a class="btn btn-outline-info" href="/contracts/tenants/{{$tenant->id}}/create">Nuevo contrato</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User related with tenant -->
                    <div class="col-12">
                        <div class="card shadow-sm mb-0">
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
                                                                <span class="badge bg-light-danger">
                                                                    <i class="bi bi-envelope-exclamation pe-1"></i>
                                                                    {{$invitation->email}}
                                                                </span>
                                                            </div>
                                                            Expiró el {{$invitation->expires_at->format('Y/m/d')}}.
                                                            Por favor vuelva a enviar una nueva invitación.
                                                        @else
                                                            <div class="text-center">
                                                                <span class="badge bg-light-success">
                                                                    <i class="bi bi-envelope-check pe-1"></i>
                                                                    {{$invitation->email}}
                                                                </span>
                                                            </div>
                                                            Valida hasta el {{$invitation->expires_at->format('Y/m/d')}}.
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                        @can('invite', $tenant)
                                            <a class="btn btn-outline-primary" href="/tenants/{{$tenant->id}}/invite">Invitar</a>
                                        @endcan
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