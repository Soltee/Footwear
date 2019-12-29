<template>
    <div class="">
        <div if="message">
            <mge :message="message"></mge>
        </div>

        <div v-if="isAdded">
            <a :href='`/cart-details`'>
                <span class="p-2 rounded-lg text-white text-md cursor-not-allowed bg-green-900 opacity-50">In Cart</span>
            </a>
        </div>
        <form v-else @submit.prevent="addToCart">
           
            <button type="submit" :class="(isAdded) ? 'cursor-not-allowed bg-green-900 opacity-50' : 'bg-black'" class="p-3 rounded-lg text-white text-md hover:opacity-75"> Add To Cart</button>
        </form>
        
    </div>
</template>

<script>
import mge from './helpers/message';
import { serverBus } from '../../app.js';    
    export default {
        name : 'add-to-cart',
        props : ['product'],
        components : {
            mge
        },
        data(){
        	return {
                isAdded : false,
                message   : null,
                err       : null
        	}
        },
        mounted() {
            this.isProductAlreadyAdded();
        },
        methods: {
            addToCart(){
                axios.get(`/add-to-cart/${this.product.id}`)
                    .then((res) => {
                        if(res.status == 200){
                            serverBus.$emit('product-added-to-cart');
                            this.isAdded = true;
                            this.message = "Product added to my cart";
                            this.removeMessage();
                        }
                    }).catch(error => this.err = 'There has been some error.');

            },
            isProductAlreadyAdded(){
                axios.get(`/is-already-added/${this.product.id}`)
                    .then((res) => {
                        console.log(res.data);
                        if(res.data.isAdded){
                            this.isAdded = true;
                        } else {
                            this.isAdded = false;
                        }
                    }).catch(error => this.err = 'There has been some error.');
            },
            removeMessage(){
                setTimeout(() => {
                    this.message = null;
                    this.err = null;
                }, 3000);
            }
        }
    }
</script>
<style scoped>
    
</style>
