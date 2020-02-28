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
    @if(Route::currentRouteName() == 'cart.checkout')
      <script src="https://js.braintreegateway.com/web/3.56.0/js/client.min.js"></script>
      <script src="https://js.braintreegateway.com/web/3.56.0/js/hosted-fields.min.js"></script>
      <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>

      <script src="https://khalti.com/static/khalti-checkout.js"></script>
      <!-- Load the PayPal Checkout component. -->
      <script src="https://js.braintreegateway.com/web/3.56.0/js/paypal-checkout.min.js"></script>
      <script src="https://js.stripe.com/v3/"></script>
      <style type="text/css">
            /**
             * The CSS shown here will not be introduced in the Quickstart guide, but shows
             * how you can use CSS to style your Element's container.
             */
            .StripeElement {
              box-sizing: border-box;

              height: 40px;

              padding: 10px 12px;

              border: 1px solid transparent;
              border-radius: 4px;
              background-color: white;

              box-shadow: 0 1px 3px 0 #e6ebf1;
              -webkit-transition: box-shadow 150ms ease;
              transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
              box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
              border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
              background-color: #fefde5 !important;
            }
      </style>
    @endif
    <!--   <link href="{{ asset('css/sm.css') }}" rel="stylesheet"> -->
</head>
<body class="bg-gray-100 h-screen antialiased leading-none text-lg">
    <div id="app"  class="">
        <nav class="relative bg-black z-10 opacity-95 overflow-hidden {{ Route::currentRouteName() == 'welcome' ? 'h-screen ' : ''}}" >
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
                    <Navmenu :customer="{{ json_encode(Auth::guard('customer')->user()) }}"></Navmenu>
                </div>
            </div>

          @if(Route::currentRouteName() == 'welcome')
           <img class="absolute inset-0  bg-cover  object-right -z-10" src="{{ asset('img/lg-bk.jpg') }}" alt="Hero Background">

           <div class="w-full  px-6  lg:px-12 mt-32 z-10 flex flex-col  items-center justify-center py-2">
                  <h1 class=" leading-tight font-bold text-md md:text-xl lg:text-2xl text-custom-red-light">
                      Thousands of shoes.
                  </h1>
                  <p class=" text-3xl md:text-4xl  lg:text-5xl  text-white mt-6 font-bold">Get branded shoes for your next wear.</p>
                  <a href="/shoes" class="w-48 px-4 py-3 text-center mt-6 text-lg text-custom-gray bg-custom-red-darker hover:bg-custom-red-lighter rounded-full">
                      Grab Now
                  </a>
            </div>
          @endif
        </nav>

        @include('sweetalert::alert')
        <main>
        @yield('content')
        </main>

        <footer-view></footer-view>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')

</body>
</html>