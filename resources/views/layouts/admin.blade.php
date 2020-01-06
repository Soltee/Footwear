<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray h-screen antialiased leading-none ">
    <div id="app" class="min-h-screen bg-admin-bk xl:container xl:mx-auto">
        @auth('administrator')
            <admin-bar :admin="{{ json_encode(Auth::guard('administrator')->user()) }}"></admin-bar>
        @endauth
        @include('sweetalert::alert')
        

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>
