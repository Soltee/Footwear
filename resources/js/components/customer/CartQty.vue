<template>
	<div class="relative flex items-center">
        <li @click="cartModal = !cartModal" class="relative flex items-center cursor-pointer">
            <svg class="icon" fill="" viewBox="0 0 59 57"  xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.8" d="M3 3H12.538L18.9285 35.1297C19.1465 36.2344 19.7437 37.2268 20.6156 37.933C21.4875 38.6393 22.5784 39.0145 23.6975 38.9929H46.8748C47.9938 39.0145 49.0848 38.6393 49.9566 37.933C50.8285 37.2268 51.4257 36.2344 51.6438 35.1297L55.459 14.9976H14.9225" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.8" d="M21.7961 53.3901C23.0033 53.3901 23.9819 52.3158 23.9819 50.9906C23.9819 49.6653 23.0033 48.591 21.7961 48.591C20.589 48.591 19.6104 49.6653 19.6104 50.9906C19.6104 52.3158 20.589 53.3901 21.7961 53.3901Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                <path opacity="0.8" d="M45.842 53.3901C47.0492 53.3901 48.0278 52.3158 48.0278 50.9906C48.0278 49.6653 47.0492 48.591 45.842 48.591C44.6349 48.591 43.6562 49.6653 43.6562 50.9906C43.6562 52.3158 44.6349 53.3901 45.842 53.3901Z" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="cart-text">{{ cartTotalQty }}</span>
        </li>
        <div v-if="cartModal" class="absolute right-0 top-0 mt-8 p-3 w-64 bg-blue-500 rounded-lg text-white">
            <a :href="`/cart-details`">Go To Cart</a>
            <div v-if="products.length > 0" v-for="product in products" class="flex flex-row jusify-start">
                <img class="h-10 w-10 rounded-lg object-cover object-center" :src="`/storage/${ (product.imageUrl) ? product.imageUrl : product.attributes.imageUrl }`">
                <div class="flex flex-col items-left justify-start pl-2">
                    <h3 class="m-0">{{ product.name }}</h3>
                    <h3 class="m-0">$ {{ product.price }}</h3>
                    <span>{{ (product.qty) ? product.qty : product.quantity  }}</span>
                </div>
            </div>
            <div v-else>
                <p class="p-2 rounded-lg bg-red-500 text-white">My cart is empty.</p>
            </div>
        </div>
    </div>
</template>
<script>
import { serverBus } from '../../app.js';    

    export default {
        name : 'cart-qty',
        data(){
        	return {
                cartModal : false,
                cartTotalQty : 0,
                products : [],
                grandTotal: 0,
                err       : null
        	}
        },
        created(){
            serverBus.$on('product-added-to-cart', (p) => {
                this.cartTotalQty += 1;
                this.products.unshift(p);
            });
            serverBus.$on('cart-updated', (p) => {
                // console.log(p.p.p); 
                let product = p.p.p;  
                this.products = this.products.filter((state) => {
                    return state.id !== product.id;
                });
                this.cartTotalQty += (Number(p.p.qty) - product.quantity);
                this.products.unshift(product);
            });
            serverBus.$on('product-removed', (p) => {
                // console.log(qty);
                // let product = p.p.p;  
                this.cartTotalQty -= p.quantity;
                this.products = this.products.filter((state) => {
                    return state.id !== p.id;
                });
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