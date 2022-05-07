<x-guest title="Iniciar sesión">
    <div class="page-content px-3">
        <section class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <a href="/"><img src="assets/images/logo/logo.png" class="img-fluid w-25 mx-auto d-block my-4" alt="Logo"></a>
                <div class="card shadow-lg">
                    <div class="card-header bg-light-success">
                        <h4 class="card-title text-center fs-2 m-0">Inicio de sesión</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <x-forms.input 
                                    label="Correo"
                                    name="email"
                                    type="email"
                                    placeholder="Correo electronico"
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

                                <div class="form-check">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="form-check-input form-check-success form-check-glow" id="remember_me" name="remember">
                                        <label class="form-check-label text-gray-600" for="remember_me">Mantener la sesión iniciada</label>
                                    </div>
                                </div>

                                <button class="btn btn-success btn-block shadow mt-4">Iniciar sesión</button>
                            </form>
                            <div class="text-center mt-4 text-lg">
                                <p class="text-gray-600">
                                    ¿No tienes una cuenta? 
                                    <a href="/register" class="font-bold link-success">Registrate</a>.
                                </p>
                                <p>
                                    <a href="{{ route('password.request') }}" class="font-bold link-success">
                                        ¿Olvidaste tu contraseña?
                                    </a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest>