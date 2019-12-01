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
    <div id="app">
        <nav class="relative">
            @if(Route::currentRouteName() == 'welcome')
                <img class="background -z-10 -mt-16 md:mt-0" src="/img/blob.svg" alt="background">
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
                    <svg class="block md:hidden w-8 h-8 text-custom-gray cursor-pointer hover:text-custom-gray-lighter" viewBox="0 0 34 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.798828" width="33.2015" height="4" rx="2" fill="currentColor"/>
                        <rect x="0.798828" y="12" width="33.2015" height="4" rx="2" fill="currentColor"/>
                        <rect x="0.798828" y="24" width="33.2015" height="4" rx="2" fill="currentColor"/>
                    </svg>

                    <div class=" hidden  md:inline-flex flex md:flex-row md:items-center text-right">
                       <search></search>
                        
                        <li class="ml-4">
                            <a href="" class="text-custom-gray hover:opacity-75">
                                Shoes
                            </a>
                        </li>
                        <li class="ml-4">
                            <a href="" class="text-custom-gray hover:opacity-75">
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
                            <li class="ml-6">
                                <a href="" class="flex items-center content-between bg-custom-red-darker hover:bg-custom-red-lighter  px-8 py-1 rounded-full">
                                    <svg class="w-8 h-8 text-custom-gray" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"/></svg>
                                    <span class="text-custom-gray ml-3 font-bold text-lg">Login</span>
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
        <main>
        @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>
