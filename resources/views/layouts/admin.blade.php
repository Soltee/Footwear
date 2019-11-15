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
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-blue-900 shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-between">
                    <div class="mr-6 flex items-center">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline mr-3">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        @auth('administrator')

                            <search-all-view />

                        @endauth
                    </div>
                    <div class="flex flex-row items-center text-right">
                        @auth('administrator')
                            <span class="text-gray-300 text-sm pr-4">{{ auth('administrator')->user()->name }}</span>
                            <a href="{{ route('administrator-logout') }}"
                                   class="no-underline hover:underline text-gray-300 text-sm p-3"
                                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('administrator-logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('board-login') }}">{{ __('Login') }}</a>
                        @endauth
                            
                    </div>
                </div>
            </div>
        </nav>

        @if(session('success'))
            <div id="message"  class="bg-green-900 rounded-lg ml-auto shadow text-center py-2 w-64 text-gray-300">
                    {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>
