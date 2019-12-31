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
    <div id="app" class="bg-admin-bk">
        @auth('administrator')
        <nav class="shadow mb-8 py-6 md:px-10">
            <div class="container mx-auto md:px-0">
                <div class="flex items-center justify-between">
                    <div class="mr-6 flex items-center">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline mr-3">
                            <svg class="h-16 w-16" viewBox="0 0 95 79" fill="none" xmlns="http://www.w3.org/2000/svg">
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

                        <search-all-view />

                    </div>
                    <div class="flex flex-row items-center text-right">
                        <div class="flex items-center justify-around w-full md:w-24 px-2 py-1 bg-custom-gray-lighter rounded-lg">
                            <img class="h-8 w-8 p-1 text-white bg-white rounded-full" src="/svg/avatar.svg">
                            {{-- <svg  class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg> --}}
                            <svg class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                        {{-- <div>
                            <a href="" class="mt-2 flex items-left mb-2 no-underline">
                                <svg class="h-6 w-6 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                                <span class="text-custom-gray ml-2">Profile</span>
                            </a>
                            <a href="/customer-logout"
                               class="flex items-left no-underline text-custom-gray text-lg"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <svg class="h-6 w-6 text-custom-gray cursor-pointer hover:text-custom-gray-light"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/></svg>
                                <span class="text-custom-gray ml-2">Logout</span>
                            </a>
                            <form id="logout-form" action="/customer-logout" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div> --}}
                            <a href="{{ route('administrator-logout') }}"
                                   class="no-underline hover:underline text-gray-900 text-lg font-bold p-3"
                                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('administrator-logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>                            
                    </div>
                </div>
            </div>
        </nav>
        @endauth
        @include('sweetalert::alert')


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>
