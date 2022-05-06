<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>{{ $attributes['title'] ?? 'Apartments' }}</title>

        <link rel="stylesheet" href="{{ asset('css/nunito-font.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">    
        <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <link rel="shortcut icon" href="{{ $attributes['icon-href'] ?? asset('assets/images/favicon.svg') }}" type="image/x-icon">
        @stack('stylesheets')
    </head>
    <body>
        <div id="app">
            <div id="main">
                {{ $slot }}
                {{-- <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="http://ahmadsaugi.com">A. Saugi</a></p>
                        </div>
                    </div>
                </footer> --}}
            </div>
        </div>
        <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/mazer.js') }}"></script>
        @stack('scripts')
    </body>
</html>
