<x-guest title="Registrarse">
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
                <img src="{{asset('assets/images/errors/error_500.png')}}" class="img-fluid w-50 mx-auto d-block mb-5" alt="Logo">
                <div class="card shadow-lg">
                    <div class="card-header bg-danger">
                        <h4 class="card-title text-center text-white fs-1 m-0">Error 500</h4>
                    </div>
                    <div class="card-content bg-light-danger rounded">
                        <div class="card-body text-center">
                            <span class="fs-3">
                                Hubo un problema en el servidor
                            </span>
                            <a href="{{url()->previous()}}" class="btn btn-outline-danger">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-background-image>
</x-guest>