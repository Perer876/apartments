<x-base>
    @include('partial.sidebar')
    <div class="page-heading">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Invitar a {{$tenant->name}}</h3>
                <p class="text-subtitle text-muted">Invitar a tu inquilino le permitirá registrarse y llevar un seguimiento de sus contratos contigo.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <x-breadcrumb align="right">
                    <x-breadcrumb.item href="{{route('home')}}">Dashboard</x-breadcrumb.item>
                    <x-breadcrumb.item href="/tenants">Inquilinos</x-breadcrumb.item>
                    <x-breadcrumb.item href="{{$tenant->href}}">{{$tenant->name}}</x-breadcrumb.item>
                    <x-breadcrumb.item>Invitar</x-breadcrumb.item>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-light-primary">
                        <h4 class="card-title">Enviar invitación</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/tenants/{{$tenant->id}}/invite" method="post">
                                @csrf
                                <x-forms.input 
                                    label="Correo" 
                                    name="email" 
                                    type="email" 
                                    placeholder="Correo destinatario" 
                                    value="{{
                                        $tenant->registration_tokens()->latest()->first() ?
                                            $tenant->registration_tokens()->latest()->first()->email :
                                            null
                                    }}"
                                >
                                    <x-slot name="addonsRight">
                                        <x-forms.input.addon icon="bi-envelope-plus" />
                                    </x-slot>
                                </x-forms.input>

                                <x-forms.input 
                                    label="Fecha de caducación" 
                                    type="text" 
                                    name="expires_at"
                                    placeholder="Fecha"
                                    autocomplete="off"
                                    value="{{now()->addMonth()->format('Y/m/d')}}"
                                >
                                    <x-slot name="datepicker"
                                        data-date-autoclose="true"    
                                        data-date-format="yyyy/mm/dd"
                                        data-date-today-highlight="true"
                                        data-date-start-date="+1w +1d"
                                        data-date-end-date="+2m"
                                        data-date-immediate-updates="true"
                                        data-date-title="Fecha de caducación"
                                    ></x-slot>
                                    <x-slot name="addonsRight">
                                        <x-forms.input.addon icon="bi-calendar-date"/>
                                    </x-slot>
                                </x-forms.input>

                                <div class="d-grid gap-2 d-sm-block my-3 text-end">
                                    <button type="submit" class="btn btn-primary ms-sm-2">Enviar</button>
                                    <a class="btn btn-light-secondary ms-sm-2" href="/tenants/{{$tenant->id}}">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-base>