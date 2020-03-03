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
<body class="bg-gray-300 antialiased leading-none text-lg">
    <div id="app"  class="">
                  
                   
      <navmenu :customer="{{ json_encode(Auth::guard('customer')->user()) }}"></navmenu>
               

          {{-- @if(Route::currentRouteName() == 'welcome')
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
          @endif --}}

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