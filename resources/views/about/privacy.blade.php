@extends('layouts.app')
{{-- <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> --}}
{{-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> --}}

@section('title', 'Privacy Policy')

@section('head')
	<meta property="og:title" content="Privacy Policy">
	<meta property="og:description" content="Foot-wear Privacy Policy
	Effective as of January 31, 2020.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	This “Privacy Policy” describes the privacy practices of Foot-wear inc...">

@endsection

@section('content')
	<div class="">

		<div class="flex flex-row items-center mb-5">
            <a href="/" class=" text-md md:text-lg  text-custom-light-black">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                <polyline points="13 17 18 12 13 7"></polyline>
                <polyline points="6 17 11 12 6 7"></polyline>
            </svg>
            <h4 class=" text-md md:text-lg md:text-lg  text-custom-light-black {{ Route::currentRouteName() === 'policy' ? 'font-bold' : '' }}">Privacy Policy</h4>
        </div>
		<h1 class="text-2xl text-center text-custom-light-black  px-3 py-3 rounded font-bold mb-5">Foot-wear Privacy Policy</h1>
		<h5 class="text-custom-light-black mb-3 ">Effective as of May 31, 2020.</h5>


		<p class="leading-6 text-custom-light-black mb-2 leading-6">  
			This “Privacy Policy” describes the privacy practices of Foot-wear, Inc., and our subsidiaries and affiliates (collectively, “Foot-wear”, “we”, “us”, or “our”) in connection with the {{ env('APP_URL') }} website, the Foot-wear mobile application, any other website or mobile application that we own or control and which posts or links to this Privacy Policy (the “Sites”) as well as our retail stores and related services (together with the Sites, the “Service”), and the rights and choices available to individuals with respect to their information. 
		</p>
		

		<h2 class="mt-6 mb-4 text-custom-light-black text-xl font-semibold">Table of Contents</h2>
		
		<privacy-policy />  

	</div>
@endsection
