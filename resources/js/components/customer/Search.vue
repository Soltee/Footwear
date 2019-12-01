<template>
    <div class="container ">
        <li class="">
            <a href="#" class="flex items-center" v-if="!status" @click="status = true">
                <svg class="w-8 h-8 text-custom-gray hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                </svg>
            </a>
            <form class="relative flex items-center" v-if="status">
                <button type="submit">
                    <svg class="absolute top-0 left-0 mt-0 ml-1 w-8 h-8 p-1 cursor-pointer text-black hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                    </svg>
                </button>
                <input type="text" v-model="key" class="px-2 py-2 pl-10 rounded-full w-full" placeholder="Search shoes" />
                <svg @click="status = false" class="cursor-pointer text-custom-red-darker absolute top-0 right-0 mt-0 mr-1 w-8 h-8 p-1"  viewBox="0 0 43 43" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <rect x="7.07129" width="50" height="10" rx="5" transform="rotate(45 7.07129 0)" fill="currentColor"/>
                    <rect y="35.3553" width="50" height="10" rx="5" transform="rotate(-45 0 35.3553)" fill="currentColor"/>
                </svg>

            </form>
        </li>
       
    </div>
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'search',
        props : [],
        data(){
        	return {
                key : "",
                status: false,
                error: null
        	}
        },
        mounted() {
           
        },
        methods: {

            async searchProducts(){
                axios.get('/getUpdatedData')
                .then(res => {
                    if(res.status == 200){
                        this.subTotal = res.data.subTotal;
                        this.updatedQty = res.data.updatedQty;
                    }
                }).catch(err => {
                    this.status = false;
                    this.err = "There has been some error.";
                    this.removeMessage();
                });
            },
            async clearCart(){
                axios.post('/clear-cart', {})
                .then(res => {
                    if(res.status == 204){
                        serverBus.$emit('cart-cleared');  
                        this.productsArr = [];
                        this.updatedQty = 0;
                        this.subTotal = 0;
                        this.grandTotal = 0;
                        this.status = true;
                        this.message = 'My cart has been cleared.';
                        this.removeMessage();
                    }
                }).catch(err => {
                    this.status = false;
                    this.err = "There has been some error.";
                    this.removeMessage();
                });
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
