<template>
    <div class="container ">
        <p v-if="message" :class="(status) ? 'bg-green-500' : 'bg-red-500' " class="rounded-lg text-md font-medium  text-white">
            {{ message }}
        </p>
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

        <div class="flex flex-col items-center">
            <span>$ {{ subTotal }}</span>
            <span>$ {{ grandTotal }}</span>
        </div>
        
    </div>
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'cart-view',
        props : ['products', 'sub', 'grand'],
        data(){
        	return {
                productsArr : [],qty: "",
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
                // let obj = this.productsArr.find(obj => obj.id == p.id);
                // obj.quantity = this.qty;
                // console.log(this.productsArr);
                // this.productsArr = this.productsArr.filter((state) => {
                //         return state.id !== p.id;
                // });
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
                        this.removeMessage(); 
                        serverBus.$emit('cart-updated',  { p : {p, qty} });  
                    }
                    if(res.status == 204) {

                        serverBus.$emit('product-removed', p);  
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
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
            async clearCart(){
                axios.post('/clear-cart', {})
                .then(res => {
                    if(res.status == 204){
                        serverBus.$emit('cart-cleared');  
                        this.productsArr = [];
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
