<x-guest title="Depadmin">
    <x-background-image id="intro" url="{{asset('assets/images/auth/background.jpg')}}" class="vh-100 p-3">
        @if (Route::has('login'))
            <ul class="nav fw-bold mb-3">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endif
                @endauth
            </ul>
        @endif
        <section class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
                <img src="assets/images/logo/logo.png" class="img-fluid w-50 mx-auto d-block" alt="Logo">
            </div>
        </section>
    </x-background-image>
</x-guest>