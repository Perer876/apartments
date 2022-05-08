<x-guest title="Depadmin">
    <div class="page-content px-3">
        <section class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <a href="/"><img src="{{ asset('assets/images/logo/logo.png')}}" class="img-fluid w-25 mx-auto d-block my-4" alt="Logo"></a>
                <div class="card shadow-lg">
                    <div class="card-content">
                        <div class="card-header bg-light-info">
                            <h4 class="card-title text-center fs-2 m-0">{{ __('Reset Password') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <x-forms.input 
                                    label="{{ __('Email') }}"
                                    name="email"
                                    type="email"
                                    placeholder="Correo electronico"
                                    value="{{$request->email}}"
                                    readonly
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

                                <div class="d-grid gap-2 d-sm-block text-end mt-4">
                                    <button type="submit" class="btn btn-info shadow ms-md-4">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest>