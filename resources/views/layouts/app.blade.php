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
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    @yield('extra')
    

</head>
<body class="bg-gray-100 h-screen antialiased leading-none text-lg">
    <div id="app"  class="">
        <nav class="relative  z-10 bg-gray-800 overflow-hidden {{ Route::currentRouteName() == 'welcome' ? 'h-screen ' : ''}}" >
            <div class="px-3 md:px-6 lg:px-12 z-10 py-3 md:py-6">
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

                    <div  x-data="{ open: false }" class="flex flex-col md:flex-row justify-around items-center">
                        <searchncart></searchncart>

                        <li class="mr-6 ">
                            <a href="/shoes">
                                <h4 class="text-lg text-custom-gray font-bold">Shoes</h4>
                            </a>      
                        </li>
                        
                        @auth('customer')
                          <li  class="flex items-center flex-row ">
                              <a  href="/dashboard" class="mr-6">
                                  @if(Auth::guard('customer')->user()->avatar)
                                    <img class="h-8 w-8 p-1 text-white bg-white rounded-full" src="/storage/{{ Auth::guard('customer')->user()->avatar }}" alt="">
                                  @else
                                    <img class="h-8 w-8 p-1 text-white bg-white rounded-full" src="/svg/avatar.svg" alt="">
                                  @endif
                              </a>
                              <button x-on:click="open = true">
                                <svg class="h-8 w-8 p-1 text-white rounded-full" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M16 9v-4l8 7-8 7v-4h-8v-6h8zm-2 10v-.083c-1.178.685-2.542 1.083-4 1.083-4.411 0-8-3.589-8-8s3.589-8 8-8c1.458 0 2.822.398 4 1.083v-2.245c-1.226-.536-2.577-.838-4-.838-5.522 0-10 4.477-10 10s4.478 10 10 10c1.423 0 2.774-.302 4-.838v-2.162z"/></svg>
                              </button>
                             
                          </li>
                        @else
                          <li>
                              <a href="/login" class="flex items-center content-between bg-custom-red-darker hover:bg-custom-red-lighter  px-4 py-1 rounded-full">
                                  <svg class="w-8 h-8 text-custom-gray" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"/></svg>
                                  <span class="text-custom-gray ml-3 font-bold text-lg">Login</span>
                              </a>
                          </li>
                        @endauth
                  
                         <div x-show="open" :class="(open) ? '' : 'hidden'"  class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
                            <div x-on:click.away="open = false" class="h-full w-full bg-transparent">
                    
                            </div>
                            <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
                                <div class="text-right">
                                    <button type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                                        <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                        </svg>
                                    </button>
                                </div>
                                <p class="mt-4 text-lg font-semibold text-red-800 text-center">Are you sure? You want to logout ?</p>
                                <div class="mt-6 mb-3 flex justify-end">
                                    <button  x-on:click.away="open = false" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Discard</button>
                                    <form id="logoutForm" class="" method="POST" action="/customer-logout">
                                      @csrf
                                      <button type="submit" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded-lg">Logout</button>                            
                                    </form>
                                </div>
                                
                            </div>

                        </div>
                    </div>
                       
                    
                    {{-- <Navmenu :customer="{{ json_encode(Auth::guard('customer')->user()) }}"></Navmenu> --}}
                </div>
            </div>

          @if(Route::currentRouteName() == 'welcome')
           <img class="absolute inset-0  bg-cover  object-right -z-10" src="{{ asset('img/lg-bk.jpg') }}" alt="Hero Background">

           <div class="w-full  px-6  lg:px-12 mt-32 z-10 flex flex-col  items-center justify-center py-2">
                  <h1 class=" leading-tight font-bold text-md md:text-xl lg:text-2xl text-custom-red-darker">
                      Thousands of shoes.
                  </h1>
                  <p class=" text-3xl md:text-5xl  text-white mt-8 font-bold">Get branded shoes for your next wear.</p>
                  <a href="/shoes" class="w-48 px-6 py-4 text-center mt-8 text-lg text-custom-gray bg-custom-red-darker hover:bg-custom-red-lighter rounded-full">
                      Grab Now
                  </a>
            </div>
          @endif
        </nav>

        @include('sweetalert::alert')
        <main>
        @yield('content')
        </main>

    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>