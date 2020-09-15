<template>
	<div>
		<div
		    class="flex flex-col md:flex-row">
			<div class="">
				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							@click="tab = 'order-detail'"
							:class=" (tab === 'order-detail') ? '' : ''"
							class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">1. Order enquiry</h3>
						<svg @click="tab = 'order-detail'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div v-if="tab === 'order-detail'"
						>
						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">What happens if I’m not available to take delivery?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							If you’re not in when the courier attempts delivery, you’ll be left a delivery card telling you either that they’ve left your parcel in a safe place (such as on a porch or with a neighbour) or the next available delivery date. The courier will then try to deliver your parcel three times, usually on consecutive days, before returning it to the depot to await further instructions.
						</p>

						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">Can I amend an order once placed?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							Sorry – you can’t change an order once it’s been placed. If you’ve changed your mind, you have 14 days from the date of delivery to return your order for a full refund.
						</p>

						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">How do I cancel an order?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							If you want to cancel your order, let us know as soon as possible after ordering by emailing soltee@gmail.com
						</p>
					</div>

				</div>

				<!-- Delivery Options -->
				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							@click="tab = 'delivery'"
							:class="( tab === 'delivery') ? '' : ''"
							class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">2. Delivery & Support</h3>
						<svg @click="tab = 'delivery'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div v-if="tab === 'delivery'"
						>
						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">What delivery options do you offer?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							We're currently offering Standard Home Delivery as well as Standard Click & Collect to any open stores, both of which you can expect to arrive within 10 days.
						</p>

					</div>

				</div>

				<!-- TECHNICAL -->
				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							@click="tab = 'technical'"
							:class="(tab === 'delivery') ? '' : ''"
							class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">3. technical</h3>
						<svg @click="tab = 'technical'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div v-if="tab === 'technical'"
						>
						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">How do I change my online details?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							Just log into <a href="/login" class="font-semibold">your account</a>. This is where you can update your personal details like your email address, name, password, contact number and reward card number. Click the ‘Address Book’ tab to add, edit or delete billing and delivery addresses.
						</p>

			

					</div>

				</div>


				<!--RETURNS & REFUNDS -->
				<div 
					 class="flex flex-col mb-5">
					<div 
					 class="flex justify-between items-center mb-6 py-3">
						<h3 
							@click="tab = 'return'"
							:class="(tab === 'delivery') ? '' : ''"
							class="text-custom-light-black cursor-pointer hover:bg-custom-light-orange  rounded-t rounded-l rounded-r-none hover:text-white font-semibold uppercase">3. RETURNS & REFUNDS</h3>
						<svg @click="tab = 'return'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
					</div>

					<div v-if="tab === 'return'"
						>
						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">Can I return an item if I change my mind?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							Of course! We offer in-store or postal returns - for up-to-date information about our refunds and returns policy.
						</p>

						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">What happens if my order arrives damaged/faulty?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							If you’ve bought or received a product that’s damaged or faulty, pop into any of our stores along with your invoice or receipt for an exchange or refund. You can also send a picture of the problem to soltee@gmail.com, along with your order number, where our customer care team will be happy to help arrange a refund with you, including the cost of returning the item to us if you want to return it by post. Please make sure you safely dispose of any broken glass before returning your item to us.
						</p>

						<h4 class="mb-2 font-semibold text-md md:text-lg md:text-lg  text-custom-light-black ">Do you offer exchanges?</h4>
						<p class="leading-6 text-custom-light-black mb-6">
							Yes – staff at your local store will be more than happy to arrange an exchange as long as the item you’re after is in stock. If not, they’ll be able to offer you a refund. Unfortunately we don't offer online exchanges.
						</p>

					</div>

				</div>

			</div>

		</div>

	</div>
</template>

<script>

export default {
	name: 'faq',
	data(){
		return{
			tab : 'order-detail'
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
