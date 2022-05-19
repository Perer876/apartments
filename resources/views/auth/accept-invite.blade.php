<x-guest title="Aceptar invitación">
    <div class="page-content px-3">
        <section class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <a href="/"><img src="{{asset('assets/images/logo/logo.png')}}" class="img-fluid w-25 mx-auto d-block my-4" alt="Logo"></a>
                <div class="card shadow-lg">
                    <div class="card-header bg-light-success">
                        <h4 class="card-title text-center fs-2 m-0">Aceptar invitación</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <p class="card-text">
                                Hola <span class="fw-bold">{{$user->name}},</span> tu arrendador 
                                <span class="fw-bold">{{$tenantToken->tenant->lessor->name}}</span>
                                te ha enviado una invitación para que puedas administrar tus contratos con el.
                            </p>
                            <form method="POST" action="{{ route('tenant.accept', $tenantToken->tenant) }}">
                                @csrf
                                <input type="hidden" name="token" value="{{$tenantToken->plain_token}}">
                                <button class="btn btn-success btn-block shadow mt-4">Aceptar invitación</button>
                            </form>
                            <a href="{{route('home')}}" class="btn btn-danger btn-block shadow mt-4">No aceptar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest>