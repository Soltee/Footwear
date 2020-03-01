<template>
	<div class="relative flex items-center md:mx-12 mr-6 md:mt-3">
        <li  class="relative flex items-center cursor-pointer mb-3 md:mb-0 hover:text-custom-gray-lighter">
            <a :href="`/cart-details`">
                <svg fill="currentColor" class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
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