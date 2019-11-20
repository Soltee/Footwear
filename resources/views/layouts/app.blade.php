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
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="relative mb-8 py-6">
            <img class="background -z-10" src="/img/blob.svg" alt="background">

            <div class="container mx-auto px-6 md:px-0 z-10">
                <div class="flex items-center justify-between">
                    <div class="mr-6 flex items-center">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline mr-3">
                            <svg class="icon" viewBox="0 0 71 71" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <rect y="28.2843" width="8" height="60" rx="4" transform="rotate(-45 0 28.2843)" fill="currentColor"/>
                                <rect y="28.2843" width="40" height="10" rx="5" transform="rotate(-45 0 28.2843)" fill="currentColor"/>
                                <rect x="65.0537" y="48.0833" width="60" height="8" rx="4" transform="rotate(-135 65.0537 48.0833)" fill="currentColor"/>
                                <rect x="17.6777" y="45.9619" width="40" height="10" rx="5" transform="rotate(-45 17.6777 45.9619)" fill="currentColor"/>
                                <rect x="35.3555" y="63.6396" width="40" height="10" rx="5" transform="rotate(-45 35.3555 63.6396)" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                    <svg class="icon text-gray-lighter" viewBox="0 0 34 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.798828" width="33.2015" height="4" rx="2" fill="currentColor"/>
                        <rect x="0.798828" y="12" width="33.2015" height="4" rx="2" fill="currentColor"/>
                        <rect x="0.798828" y="24" width="33.2015" height="4" rx="2" fill="currentColor"/>
                    </svg>

                    <div class="flex flex-row items-center text-right">
                        <li class="">
                            <a href="" class="">
                                <svg class="icon text-gray-lighter" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </li>
                        
                        <li class="">
                            <a href="" class="text-gray-custom">
                                Shoes
                            </a>
                        </li>
                        <li class="">
                            <a href="" class="text-gray-custom">
                                Company
                            </a>
                        </li>
                        
                        <cart-qty ></cart-qty>
                        @auth('customer')
                            <span class="text-gray-lighter text-sm pr-4">{{ auth('customer')->user()->name }}</span>
                            <a href="{{ route('customer-logout') }}"
                                   class="no-underline hover:underline text-gray-300 text-sm p-3"
                                   onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('customer-logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <li class="">
                                <a href="" class="flex items-center bg-red-darker">
                                    <svg class="icon text-gray-lighter" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"/></svg>
                                    <span class="text-gray-lighter">Login</span>
                                </a>
                            </li>
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
