@extends('layouts.app')
{{-- <div>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> --}}
{{-- Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a> --}}

@section('title', '- Privacy Policy')

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
		<h1 class="text-2xl text-center bg-custom-light-black text-white px-3 py-3 rounded font-bold mb-5">Footwear Privacy Policy</h1>
		<h5 class="text-custom-light-black mb-3 ">Effective as of May 31, 2020.</h5>


		<p class="leading-6 text-custom-light-black mb-2 leading-6">  
			This “Privacy Policy” describes the privacy practices of Foot-wear, Inc., and our subsidiaries and affiliates (collectively, “Foot-wear”, “we”, “us”, or “our”) in connection with the {{ env('APP_URL') }} website, the Foot-wear mobile application, any other website or mobile application that we own or control and which posts or links to this Privacy Policy (the “Sites”) as well as our retail stores and related services (together with the Sites, the “Service”), and the rights and choices available to individuals with respect to their information. 
		</p>
		

		<h2 class="mt-6 mb-4 text-custom-light-black text-xl font-semibold">Table of Contents</h2>
		<div
			x-data="{ tab : 'personal-info' }"
		    class="flex flex-col md:flex-row">
			<div class="w-full md:w-64">
				<h3 
					x-on:click="tab = 'personal-info'"
					:class="{ 'bg-custom-light-orange text-white' : tab === 'personal-info' }"
					class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange px-3 py-3 rounded-t rounded-l rounded-r-none hover:text-white mb-3">Personal Information We Collect</h3>
				<h3 
					x-on:click="tab = 'use-personal'"
					:class="{ 'bg-custom-light-orange text-white' : tab === 'use-personal' }"
					class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange px-3 py-3 rounded-t rounded-l rounded-r-none hover:text-white mb-3">How We Use Your Personal Information</h3>
				<h3 
					x-on:click="tab = 'cookie'"
					:class="{ 'bg-custom-light-orange text-white' : tab === 'cookie' }"
					class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange px-3 py-3 rounded-t rounded-l rounded-r-none hover:text-white mb-3">Cookie Policy</h3>
				<h3 
					x-on:click="tab = 'security'"
					:class="{ 'bg-custom-light-orange text-white' : tab === 'security' }"
					class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange px-3 py-3 rounded-t rounded-l rounded-r-none hover:text-white mb-3">Security Practices</h3>
			</div>

			<div class="flex-1 md:pl-10">

				<!-- Personal -->
				<div
					x-show.transition.60ms="tab === 'personal-info'" 
					class="w-full">
					<h3 
						class="text-custom-light-black text-xl mb-3 font-semibold">Personal Information We Collect</h3>
					<h5 class="text-custom-light-black mb-4">Personal information you provide to us.  Personal information you may provide to us through the Service or otherwise includes:</h5>

					<ul class="m-0 flex-col">
						<li class="leading-6 text-custom-light-black mb-3 list-disc">Contact data, personal or business contact information such as your first and last name, email and mailing addresses, phone number, professional title and company name.</li>
			    		<li class="leading-6 text-custom-light-black mb-3 list-disc">Registration data, such as information that you provide to register for an account or sign up for an event, including the day and month of your birth and the event you registered for.</li>
			    		<li class="leading-6 text-custom-light-black mb-3 list-disc">Data about others for whom you purchase an item or gift, such as name, delivery address and phone number. Please do not purchase a gift for someone or share their contact information with us unless you have their permission to do so.</li>
			    	</ul>

				</div>

				<!-- HOW WE USE YOUR PERSONAL INFORMATION -->
				<div
					x-show.transition.60ms="tab === 'use-personal'" 
				 	class="w-full">
					<h3 class="text-custom-light-black text-xl mb-3 font-semibold">HOW WE USE YOUR PERSONAL INFORMATION</h3>
					<h5 class="text-custom-light-black mb-4">We use your personal information for the following purposes and as otherwise described in this Privacy Policy or at the time of collection:</h5>

					<ul class="m-0 flex-col">
						<li class="leading-6 text-custom-light-black mb-3 list-disc">Direct Marketing.  We may use your personal information to send you Fashion Nova-related marketing communications as permitted by law.  You will have the ability to opt-out of our marketing and promotional communications as described in the Your Choices section below.</li>
			    		<li class="leading-6 text-custom-light-black mb-3 list-disc">To comply with laws and regulations.  We use your personal information as we believe necessary or appropriate to comply with applicable laws, lawful requests, and legal process, such as to respond to subpoenas or requests from government authorities.</li>
			    	</ul>

				</div>

				<!--SECURITY PRATCICES-->
				<div 
					x-show.transition.60ms="tab === 'security'"
					class="w-full">
					<h3 class="text-custom-light-black text-xl mb-3 font-semibold">SECURITY POLICY</h3>
					<p class="leading-6 text-custom-light-black">
						The security of your personal information is important to us.  We employ a number of organizational, technical and physical safeguards designed to protect the personal information we collect.  However, security risk is inherent in all internet and information technologies and we cannot guarantee the security of your personal information.
					</p>
				</div>

				<!--COOKIE POLICY -->
				<div 
					x-show.transition.60ms="tab === 'cookie'"
					class="w-full">
					<h3 class="text-custom-light-black text-xl mb-3 font-semibold">COOKIE POLICY</h3>
					<h5 class="leading-6 text-custom-light-black mb-4">This Cookie Policy explains how Foot-wear, Inc.  (“Foot-wear”, “we”, “us” or “our”) uses cookies and similar technologies in connection with the www.fashionnova.com website and any other website that we own or control and which posts or links to this Cookie Policy (collectively, the “Sites”), along with the Foot-wear mobile application and any other mobile applications that we own or control and which posts or links to this Cookie Policy (collectively, the “Apps”).</h5>

					<p class="leading-6 text-custom-light-black mb-4">
						Cookies are small data files that are placed on your computer or mobile device when you visit a website. Cookies serve different purposes, like helping us understand how a site is being used, letting you navigate between pages efficiently, remembering your preferences and generally improving your browsing experience. 

						Our Sites may use both session cookies (which expire once you close your web browser) and persistent cookies (which stay on your computer or mobile device until you delete them). 

						We use two broad categories of cookies: (1) first party cookies, served directly by us to your computer or mobile device, which we use to recognize your computer or mobile device when it revisits our Sites;  and (2) third party cookies, which are served by service providers or business partners on our Sites, and can be used by these parties to recognize your computer or mobile device when it visits other websites.  Third party cookies can be used for a variety of purposes, including site analytics, advertising and social media features.
					</p>
					<ul class="m-0 flex-col mb-4">
						<li class="leading-6 text-custom-light-black mb-3 list-disc"> Analytics</li>
			    		<li class="leading-6 text-custom-light-black mb-3 list-disc">Advertising</li>
			    	</ul>

			    	<p class="leading-6 text-custom-light-black mb-2">  
			    		Information about the cookies we use may be updated from time to time, so please check back on a regular basis for any changes.
			    	</p>
				</div>
			</div>
		</div>

		<p class="leading-6 text-custom-light-black mt-6 mb-2">  
			If you have any questions about this Privacy Policy, please contact us by email at soltee@gmail.com. 
    	</p>  
    	<p class="leading-6 text-custom-light-black mt-5 mb-2">Last modified May 1, 2020.</p>

		
		{{-- <subscribe />   --}}

	</div>
@endsection
