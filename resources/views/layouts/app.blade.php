<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    @yield('extra')
    

</head>
<body class="antialiased leading-none text-lg">
    <div id="app"  class="">
                  
        <!-- Header--> 
        @if(Route::currentRouteName() != 'cart.checkout')    
            <navmenu :customer="{{ json_encode(Auth::guard('customer')->user()) }}"></navmenu>
        @endif  

        @include('sweetalert::alert')
        <!-- Content -->     
        <main class="px-6 my-0 max-w-screen-lg mx-auto">
        @yield('content')
        </main>

        <!-- Footer --> 
        @if(Route::currentRouteName() != 'cart.checkout')    
            <footer-view></footer-view>
        @endif      
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

</body>
</html>