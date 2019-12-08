<template>
    <div class="container ">
        <p v-if="message" class="rounded-lg text-md font-medium bg-green-500 text-white">
            {{ message }}
        </p>
        <div v-if="isAdded">
            <span class="p-3 rounded-lg text-white text-md cursor-not-allowed bg-green-900 opacity-50">In Cart</span>
        </div>
        <form v-else @submit.prevent="addToCart">
           
            <button type="submit" :class="(isAdded) ? 'cursor-not-allowed bg-green-900 opacity-50' : 'bg-blue-900'" class="p-3 rounded-lg text-white text-md "> Add To Cart</button>
        </form>
        
    </div>
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'add-to-cart',
        props : ['product'],
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
            async addToCart(){
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
            async isProductAlreadyAdded(){
                axios.get(`/is-already-added/${this.product.id}`)
                    .then((res) => {
                        if(res.data.isAdded){
                            this.isAdded = true;
                        } else {
                            this.isAdded = false;
                        }
                    }).catch(error => this.err = 'There has been some error.');
            },
            async removeMessage(){
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
