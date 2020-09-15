@extends('layouts.app')

@section('title', 'FAQs')

@section('head')
	<meta property="og:title" content="Sitemap">
	<meta property="og:description" content="Foot-wear Sitemap">

@endsection

@section('content')
	<div class="">
		<div class="flex flex-row items-center mb-5">
            <a href="/" class=" text-md md:text-lg  text-custom-light-black">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                <polyline points="13 17 18 12 13 7"></polyline>
                <polyline points="6 17 11 12 6 7"></polyline>
            </svg>
            <h4 class=" text-md md:text-lg md:text-lg  text-custom-light-black {{ Route::currentRouteName() === 'faq' ? 'font-bold' : '' }}">FAQs</h4>
        </div>
		<h1 class="text-2xl text-center text-custom-light-black  px-3 py-3 rounded font-bold mb-5">How can we help you?</h1>


		<faq />
	</div>
@endsection
