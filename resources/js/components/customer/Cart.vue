<template>
    <div class="container ">
        <p v-if="message" :class="(status) ? 'bg-green-500' : 'bg-red-500' " class="rounded-lg text-md font-medium  text-white">
            {{ message }}
        </p>
        <div v-if="updatedQty > 0">
            <div>
                <form @submit.prevent="clearCart">
                    <button type="submit" class="p-3 bg-red-500 rounded-lg text-lg font-medium text-white">Clear Cart</button>
                </form>
            </div>
        
            <div v-for="p in productsArr">
                <div class="flex flex-row justify-between items-center">
                    <img class="h-10 w-10 rounded-lg object-cover object-center" :src="`/storage/${p.attributes.imageUrl}`">
                    <div class="flex flex-col items-left justify-start pl-2">
                        <h3 class="m-0">{{ p.name }}</h3>
                        <h3 class="m-0">$ {{ p.price }}</h3>
                    </div>
                    <div>
                        <form @submit.prevent="updateCart(p)">
                            <div>
                                <input type="text" name="" @input="qty = $event.target.value; selected = p.id"  :value="`${(selected == p.id) ? qty : p.quantity}`">
                                <button type="submit" class="p-3 rounded-lg text-blue-900 text-md ">
                                    Update
                                </button>
                            </div>
                        </form>
                        <form @submit.prevent="removeCart(p)">
               
                            <button class="p-3 rounded-lg text-blue-900 text-md ">Drop Product</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-right ml-auto w-48">
                <div class="flex items-center border-green-600 border-2 rounded-lg p-3 mb-3">
                    <span class="text-bold text-lg text-green-600 rounded-lg mr-2">SubTotal</span>
                    <span class="text-lg text-bold text-green-500">$ {{ subTotal }}</span>
                </div>
                <div class="flex items-center ">
                    <a :href="`/checkout`" class="text-bold text-lg bg-green-900 text-white p-3 rounded-lg">Checkout</a>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="flex items-center">
                <p class="text-medium font-semibold text-blue-500">Oh! My cart is empty.</p>
                <a :href="`/`" class="text-bold text-lg bg-green-900 text-white p-3 rounded-lg">Continue My Shopping</a>

            </div>
        </div>
        
    </div>
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'cart-view',
        props : ['products', 'cart', 'sub', 'grand'],
        data(){
        	return {
                productsArr : [],qty: "",
                updatedQty : this.cart,
                subTotal : this.sub,
                grandTotal : this.grand,
                selected: null,
                status : false,
                message   : null,
                err       : null
        	}
        },
        mounted() {
            this.pushProducts();
        },
        methods: {
            async pushProducts(){
                for (let [key, value] of Object.entries(this.products)) {
                    this.productsArr.push(value);
                }
            },
            async updateCart(p){
    
                let qty = this.qty;
                axios.post(`/update-cart/${p.id}`, {
                    quantity : qty
                }).then(res => {

                    if(res.status == 200){
                        this.status = true;
                        this.message = 'Cart updated.';
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
                        this.productsArr.unshift({
                            id : p.id,
                            name : p.name,
                            price : p.price,
                            quantity : qty,
                            attributes: {
                                imageUrl : p.attributes.imageUrl
                            }
                        });
                        this.getUpdatedData();
                        this.removeMessage(); 
                        serverBus.$emit('cart-updated',  { p : {p, qty} });  
                    }
                    if(res.status == 204) {

                        serverBus.$emit('product-removed', p);  
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
                        this.getUpdatedData();
                        this.status = false;
                        this.message = 'Product removed from cart.';
                        this.removeMessage();  
                    }
                })
                .catch(err => {
                    this.status = false;
                    this.err = "There has been some error.";
                    this.removeMessage(); 
                });
            },
            async removeCart(p){
                axios.post(`/remove-from-cart/${p.id}`, {})
                .then(res => {
                    if(res.status = 204){
                        serverBus.$emit('product-removed', p);
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
                        this.getUpdatedData();
                        this.status = true;
                        this.message = 'Product has been removed from my cart.';
                        this.removeMessage();
                    }
                }).catch(err => {
                    this.status = false;
                    this.err = 'There has been some error.';
                    this.removeMessage();
                })
            },
            async getUpdatedData(){
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
