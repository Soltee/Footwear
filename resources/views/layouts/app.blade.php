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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!--   <link href="{{ asset('css/sm.css') }}" rel="stylesheet"> -->
</head>
<body class="bg-gray-100 h-screen antialiased leading-none text-lg">
    <div id="app" >
        <nav class="relative">
            @if(Route::currentRouteName() == 'welcome')
                <img class="header-blob background -z-10 -mt-16 md:mt-0" src="/img/blob.svg" alt="background">
            @endif
            <div class="px-3 md:px-6 lg:px-12 z-10 py-3 md:py-8 bg-black">
                <div class="flex items-center justify-between">
                    <div class="mr-6 flex items-center">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline mr-3">
                            <svg class="w-12 h-12" viewBox="0 0 71 71" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <rect y="28.2843" width="8" height="60" rx="4" transform="rotate(-45 0 28.2843)" fill="currentColor"/>
                                <rect y="28.2843" width="40" height="10" rx="5" transform="rotate(-45 0 28.2843)" fill="currentColor"/>
                                <rect x="65.0537" y="48.0833" width="60" height="8" rx="4" transform="rotate(-135 65.0537 48.0833)" fill="currentColor"/>
                                <rect x="17.6777" y="45.9619" width="40" height="10" rx="5" transform="rotate(-45 17.6777 45.9619)" fill="currentColor"/>
                                <rect x="35.3555" y="63.6396" width="40" height="10" rx="5" transform="rotate(-45 35.3555 63.6396)" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <Navmenu :customer="{{ json_encode(Auth::guard('customer')->user()) }}"></Navmenu>
                </div>
            </div>
        </nav>

        @if(session('success'))
            <div id="message"  class="bg-green-900 rounded-lg ml-auto shadow text-center py-2 w-64 text-gray-300">
                    {{ session('success') }}
            </div>
        @endif
        <main>
        @yield('content')
        </main>

        <footer class="relative">
            <img  class="background footer-blob -z-10 -mt-16 md:mt-0" src="/img/blob.svg" alt="background">

            <div class="flex flex-col md:flex-row items-center ">
                <ul>
                    
                </ul>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>