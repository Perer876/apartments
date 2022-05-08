<x-guest title="Depadmin">
    <div class="page-content px-3">
        <section class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <a href="/"><img src="{{ asset('assets/images/logo/logo.png')}}" class="img-fluid w-25 mx-auto d-block my-4" alt="Logo"></a>
                <div class="card shadow-lg">
                    <div class="card-content">
                        <div class="card-body">
                            <p>
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </p>
                            @if (session('status'))
                                <p class="badge bg-light-info">
                                    {{ session('status') }}
                                </p>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <x-forms.input 
                                    label="{{ __('Email') }}"
                                    name="email"
                                    type="email"
                                    placeholder="Correo electronico"
                                >
                                    <x-slot name="addonsLeft">
                                        <x-forms.input.addon icon="bi-envelope"/>
                                    </x-slot>
                                </x-forms.input>

                                <div class="d-grid gap-2 d-sm-block text-end mt-4">
                                    <button type="submit" class="btn btn-info shadow ms-md-4">
                                        {{ __('Email Password Reset Link') }}
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