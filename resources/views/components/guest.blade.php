<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $attributes['title'] ?? 'Invitado' }}</title>
        <link rel="stylesheet" href="{{ asset('css/nunito-font.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
        <link rel="shortcut icon" href="{{ $attributes['icon-href'] ?? asset('assets/images/favicon.svg') }}" type="image/x-icon">
        @stack('stylesheets')
    </head>
    <body>
        <div class="app">
            {{ $slot }}
        </div>
        @stack('scripts')
    </body>
</html>
