<template>
	<div class="relative flex items-center md:mx-12 ">
        <li  class="relative flex items-center cursor-pointer mb-3 md:mb-0 hover:text-custom-gray-lighter">
            <a :href="`/cart-details`">
                <svg class="icon" fill="" viewBox="0 0 59 57"  xmlns="http://wwwp.w3.org/2000/svg">
                    <path opacity="0.8" d="M3 3H12.538L18.9285 35.1297C19.1465 36.2344 19.7437 37.2268 20.6156 37.933C21.4875 38.6393 22.5784 39.0145 23.6975 38.9929H46.8748C47.9938 39.0145 49.0848 38.6393 49.9566 37.933C50.8285 37.2268 51.4257 36.2344 51.6438 35.1297L55.459 14.9976H14.9225" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                    <path opacity="0.8" d="M21.7961 53.3901C23.0033 53.3901 23.9819 52.3158 23.9819 50.9906C23.9819 49.6653 23.0033 48.591 21.7961 48.591C20.589 48.591 19.6104 49.6653 19.6104 50.9906C19.6104 52.3158 20.589 53.3901 21.7961 53.3901Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                    <path opacity="0.8" d="M45.842 53.3901C47.0492 53.3901 48.0278 52.3158 48.0278 50.9906C48.0278 49.6653 47.0492 48.591 45.842 48.591C44.6349 48.591 43.6562 49.6653 43.6562 50.9906C43.6562 52.3158 44.6349 53.3901 45.842 53.3901Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            <span class="absolute top-0 right-0 -mt-2 -mr-2 text-custom-red-lighter p-1 bg-custom-gray rounded-full">{{ cartTotalQty }}</span>
            </a>
        </li>
    </div>
</template>
<script>
import { serverBus } from '../../app.js';    

    export default {
        name : 'cartQty',
        data(){
        	return {
                cartTotalQty : 0,
                grandTotal: 0,
                err       : null
        	}
        },
        created(){
            serverBus.$on('product-added-to-cart', (qty) => {
                if(qty){
                    this.cartTotalQty += Number(qty);
                } else {
                    this.cartTotalQty += 1;                    
                }
            });
            serverBus.$on('cart-updated', (p) => {
                this.cartTotalQty += (Number(p.qty) - p.p.qty);
            });
            serverBus.$on('product-removed', (qty) => {

                this.cartTotalQty -= qty;
            });
            serverBus.$on('cart-cleared', () => {
                  // console.log('Yes');
                this.cartTotalQty = 0;
                this.products = [];
            });
        },
        mounted() {
            this.getCartProducts();
        },
        methods: {
            async getCartProducts(){
                axios.get(`/getCartProducts`)
                    .then((res) => {
                        if(res.status == 200){
                            let data = res.data;
                            if(data.totalQty > 0){
                                this.cartTotalQty = res.data.totalQty;
                                this.products = data.cartProducts;
                                this.grandTotal = data.grandTotal;
                            }
                        }
                    }).catch(error => this.err = 'There has been some error.');
            }
        }
    }
</script>