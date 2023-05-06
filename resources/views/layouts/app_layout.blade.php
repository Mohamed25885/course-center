<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles_top')
    @stack('scripts_top')
</head>

<body>
    <div id="app">
        <div class="container-fluid overflow-hidden">
            <div class="row vh-100 overflow-auto">
                @include('includes.sidebar')
                <div class="col d-flex flex-column h-sm-100">
                    <main class="row overflow-auto py-4">
                        @include('includes.navbar')
                        @yield('content')
                    </main>
                    @include('includes.footer')
                </div>
            </div>
        </div>
    </div>

    @stack('styles_bottom')
    @stack('scripts_bottom')

    <script src="{{asset('vendor/fontawesome/js/fontawesome.min.js')}}"></script>
</body>

</html>
