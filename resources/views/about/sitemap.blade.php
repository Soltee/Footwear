@extends('layouts.app')

@section('title', '- Sitemap')

@section('head')
	<meta property="og:title" content="Sitemap">
	<meta property="og:description" content="Foot-wear Sitemap">

@endsection

@section('content')
	<div class="mb-12">
		<div class="flex flex-row items-center mb-5">
            <a href="/" class=" text-md md:text-lg  text-custom-light-black">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                <polyline points="13 17 18 12 13 7"></polyline>
                <polyline points="6 17 11 12 6 7"></polyline>
            </svg>
            <h4 class=" text-md md:text-lg md:text-lg  text-custom-light-black {{ Route::currentRouteName() === 'sitemap' ? 'font-bold' : '' }}">Sitemap</h4>
        </div>
		<h1 class="text-2xl text-center text-custom-light-black  px-3 py-3 rounded font-bold mb-5">Foot-wear Sitemap</h1>

		<div class="flex flex-col md:flex-row mt-12">
			<div class="w-full mb-3 md:mb-0 md:w-48 md:pr-6">
				<h3 class="text-lg md:tex-2xl text-custom-light-black md:px-3 font-semibold">About</h3>
			</div>

			<div class="flex-1  grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-5">
				<a href="/home" class="mb-3 text-custom-light-black hover:font-bold">
					Home
				</a>
				<a href="/shoes" class="mb-3 text-custom-light-black hover:font-bold">
					Shop
				</a>
				<a href="/cart" class="mb-3 text-custom-light-black hover:font-bold">
					Cart
				</a>
				<a href="/faq" class="mb-3 text-custom-light-black hover:font-bold">
					FAQs
				</a>
				<a href="/privacy-policy" class="mb-3 text-custom-light-black hover:font-bold">
					Privacy Policy
				</a>
				<a href="/privacy-policy" class="mb-3 text-custom-light-black hover:font-bold">
					Cookie Policy
				</a>
			</div>
		</div>

		<div class="flex flex-col md:flex-row mt-6">
			<div class="w-full md:w-48 md:pr-6 mb-3 md:mb-0">
				<h3 class="text-lg md:tex-2xl text-custom-light-black md:px-3 font-semibold">Accounts</h3>
			</div>

			<div class="flex-1  grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-5">
				<a href="/login" class="mb-3 text-custom-light-black hover:font-bold">
					Login
				</a>
				<a href="/register" class="mb-3 text-custom-light-black hover:font-bold">
					Register
				</a>
			
			</div>
		</div>

	</div>
@endsection
