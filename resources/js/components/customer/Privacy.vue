<template>
	<div>
		<div class="flex flex-col md:flex-row">
			<div class="w-full mb-6 md:mb-0 flex flex-row md:flex-col  md:w-64">
				<h3 
					@click="tab = 'personal-info'"
					:class="(tab === 'personal-info') ? 'bg-custom-light-orange text-white' : 'text-custom-light-black'"
					class=" cursor-pointer leading-8 hover:bg-custom-light-orange px-3 py-3 md:rounded-t md:rounded-l md:rounded-r-none hover:text-white mb-3">Personal Info</h3>
				<h3 
					@click="tab = 'use-personal'"
					:class="(tab === 'use-personal') ? 'bg-custom-light-orange text-white' : 'text-custom-light-black'"
					class=" cursor-pointer leading-8 hover:bg-custom-light-orange px-3 py-3 md:rounded-t md:rounded-l md:rounded-r-none hover:text-white mb-3">Use Personal Info</h3>
				<h3 
					@click="tab = 'cookie'"
					:class="(tab === 'cookie') ? 'bg-custom-light-orange text-white' : 'text-custom-light-black'"
					class=" cursor-pointer leading-8 hover:bg-custom-light-orange px-3 py-3 md:rounded-t md:rounded-l md:rounded-r-none hover:text-white mb-3">Cookies</h3>
				<h3 
					@click="tab = 'security'"
					:class="(tab === 'security') ? 'bg-custom-light-orange text-white' : 'text-custom-light-black' "
					class=" cursor-pointer leading-8 hover:bg-custom-light-orange px-3 py-3 md:rounded-t md:rounded-l md:rounded-r-none hover:text-white mb-3">Security</h3>
			</div>
			
		<div class="flex-1 md:pl-10">

				<!-- Personal -->
				<div
					v-if="tab === 'personal-info'" 
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
					v-if="tab === 'use-personal'" 
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
					v-if="tab === 'security'"
					class="w-full">
					<h3 class="text-custom-light-black text-xl mb-3 font-semibold">SECURITY POLICY</h3>
					<p class="leading-6 text-custom-light-black">
						The security of your personal information is important to us.  We employ a number of organizational, technical and physical safeguards designed to protect the personal information we collect.  However, security risk is inherent in all internet and information technologies and we cannot guarantee the security of your personal information.
					</p>
				</div>

				<!--COOKIE POLICY -->
				<div 
					v-if="tab === 'cookie'"
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

	</div>
</template>

<script>

export default {
	name: 'privacy-policy',
	data(){
		return{
			tab : 'personal-info'
		}
	},
	methods: {
		setTab(tab)
		{
			this.tab = tab;
		}
	}
};
</script>
