<x-guest title="Registrarse">
    <div class="page-content px-3">
        <section class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <a href="/"><img src="{{asset('assets/images/logo/logo.png')}}" class="img-fluid w-25 mx-auto d-block my-4" alt="Logo"></a>
                <div class="card shadow-lg">
                    <div class="card-header bg-light-primary">
                        <h4 class="card-title text-center fs-2 m-0">Registrarse</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @isset($tenantToken)
                                <p class="card-text">
                                    Tu arrendador 
                                    <span class="fw-bold">{{$tenantToken->tenant->lessor->name}}</span>
                                    te ha invitado a registrate para que puedas ver tus contratos con el.
                                </p>
                            @endisset
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                @isset($tenantToken)
                                    <input type="hidden" name="token" value="{{$tenantToken->plain_token}}">
                                @endisset
                                <x-forms.input 
                                    label="Nombre"
                                    name="name"
                                    type="text"
                                    placeholder="Usuario"
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi-person"/>
                                    </x-slot>
                                </x-forms.input>

                                <x-forms.input 
                                    label="Correo"
                                    name="email"
                                    type="email"
                                    placeholder="Correo electronico"
                                    value="{{isset($tenantToken) ? $tenantToken->email : null}}"
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi-envelope"/>
                                    </x-slot>
                                </x-forms.input>
                                
                                <x-forms.input 
                                    label="Contraseña"
                                    name="password"
                                    type="password"
                                    placeholder="Contraseña"
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi-key"/>
                                    </x-slot>
                                </x-forms.input>
                                
                                <x-forms.input 
                                    label="Confirmar contraseña"
                                    name="password_confirmation"
                                    type="password"
                                    placeholder="Contraseña"
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi-key-fill"/>
                                    </x-slot>
                                </x-forms.input>

                                <label for="user_type">Tipo de usuario</label>
                                <div class="d-grid gap-2">
                                    <div class="btn-group" role="group" aria-label="Select user type">
                                        @if(! isset($tenantToken))
                                            <input type="radio" class="btn-check" name="role"
                                                id="role_lessor" autocomplete="off" value="lessor" checked>
                                            <label class="btn btn-outline-warning" for="role_lessor">
                                                <i class="bi-house-heart"></i>
                                                Arrendador
                                            </label>
                                        @endif
                                        <input type="radio" class="btn-check" name="role"
                                            id="role_tenant" autocomplete="off" value="tenant"
                                            @isset($tenantToken) checked @endisset>
                                        <label class="btn btn-outline-info" for="role_tenant">
                                            Inquilino
                                            <i class="bi-person-badge"></i>
                                        </label>
                                    </div>
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="mt-4">
                                        <label for="terms">
                                            <div class="flex items-center">
                                                <div class="checkbox">
                                                    <input type="checkbox" name="terms" id="terms" class="form-check-input">
                                                    <label for="terms">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-decoration-underline link-secondary">'.__('Terms of Service').'</a>',
                                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-decoration-underline link-secondary">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </label>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endif

                                <div class="d-grid gap-2 d-sm-block text-end mt-4">
                                    @isset($tenantToken)
                                        <a href="{{ route('tenant.login', $tenantToken->plain_token) }}" class="font-bold link-primary">
                                            ¿Ya estás registrado?
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="font-bold link-primary">
                                            ¿Ya estás registrado?
                                        </a>
                                    @endisset
                                    <button class="btn btn-primary shadow ms-md-4">Registrarse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest>