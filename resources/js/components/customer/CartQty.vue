<template>
	<div class="relative flex items-center">
        <div @click="cartModal = !cartModal" class="relative flex items-center cursor-pointer">
            <svg class="h-4 w-4 text-gray-300 font-medium text-md" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
            <span class="ml-2 p-1 text-md text-white font-bold bg-red-600 rounded-lg">{{ cartTotalQty }}</span>
        </div>
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