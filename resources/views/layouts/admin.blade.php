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
<body class="bg-gray h-screen antialiased leading-none">
    <div id="app">
        <nav class="shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-between">
                    <div class="mr-6 flex items-center">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline mr-3">
                            <svg class="h-10 w-10" viewBox="0 0 95 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d)">
                                <rect y="28.2843" width="8" height="60" rx="4" transform="rotate(-45 0 28.2843)" fill="#201E16"/>
                                <rect y="28.2843" width="40" height="10" rx="5" transform="rotate(-45 0 28.2843)" fill="#201E16"/>
                                <rect x="65.0537" y="48.0833" width="60" height="8" rx="4" transform="rotate(-135 65.0537 48.0833)" fill="#201E16"/>
                                <rect x="17.6777" y="45.9619" width="40" height="10" rx="5" transform="rotate(-45 17.6777 45.9619)" fill="#201E16"/>
                                <rect x="35.3552" y="63.6396" width="40" height="10" rx="5" transform="rotate(-45 35.3552 63.6396)" fill="#201E16"/>
                                </g>
                                <defs>
                                <filter id="filter0_d" x="0" y="0" width="94.7106" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                <feOffset dx="20" dy="4"/>
                                <feGaussianBlur stdDeviation="2"/>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                                </filter>
                                </defs>
                                </svg>

                        </a>
                        @auth('administrator')

                            <search-all-view />

                        @endauth
                    </div>
                    <div class="flex flex-row items-center text-right">
                        @auth('administrator')
                            <svg class="text-bg-darker w-8 h-8 cursor-pointer mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8a6 6 0 0 1 4.03-5.67 2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z"/></svg>

                            <div class="flex items-center">
                                <svg class="text-bg-darker w-8 h-8 mr-2 cursor-pointer" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8a6 6 0 0 1 4.03-5.67 2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8zm8 10a2 2 0 1 1-4 0h4z"/></svg>
                                <span class="text-bg-lighter text-md text-bold cursor-pointer">{{ auth('administrator')->user()->name }}</span>
                            </div>
                            <span class="text-gray-300 text-sm pr-4"></span>
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
