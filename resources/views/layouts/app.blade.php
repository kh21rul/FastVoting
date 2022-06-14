<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.png">

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Font-Awesome Icons --}}
    <script src="{{ asset('vendor/fontawesome/fontawesome-icons.min.js') }}" defer></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        @include('components.navbar')

        <main>
            @yield('content')
        </main>
    </div>
    <footer class="w-100 mt-auto d-flex flex-wrap justify-content-between align-items-center py-2 my-1 border-top">
        <div class="d-flex align-items-center text-center mx-auto">
            <span class="text-muted">&copy; 2022 {{ config('app.name') }}</span>
        </div>
    </footer>
</body>
</html>
