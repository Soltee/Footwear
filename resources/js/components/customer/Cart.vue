<template>
    <div class="relative  w-full px-6  lg:px-12 flex flex-col bg-gray-300 py-6" :class="(modal) ? 'bg-gray-400' : ''">

        <div v-if="message"  :class="(status) ? 'bg-green-500' : 'bg-red-500' " class="absolute top-0 right-0 rounded-lg text-md flex flex-row justify-between items-center font-medium  text-white p-3 mb-2">
            <span class="mr-6 w-64">{{ message }}</span>
            <svg @click="message = null" class="cursor-pointer text-custom-red-darker  w-6 h-6"  viewBox="0 0 43 43" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <rect x="7.07129" width="50" height="10" rx="5" transform="rotate(45 7.07129 0)" fill="currentColor"/>
                <rect y="35.3553" width="50" height="10" rx="5" transform="rotate(-45 0 35.3553)" fill="currentColor"/>
            </svg>
        </div>
        <div v-if="updatedQty > 0" class="container mx-auto">
            <div class="flex justify-between items-center">
                <h4 class="font-bold text-lg text-gray-900">My Cart</h4>
                <!-- <form @submit.prevent="clearCart"> -->
                    <button @click="modal = true;" type="submit" class="p-3 bg-red-500 rounded-lg text-lg font-medium text-white">Clear Cart</button>
                <!-- </form> -->
            </div>
            <div class="overflow-x-scroll w-full mt-6">
                
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                          <th class="px-4 py-3 text-left text-gray-900">Id</th>
                          <th class="px-4 py-3 text-left text-gray-900">Image</th>
                          <th class="px-4 py-3 text-left text-gray-900">Name</th>
                          <th class="px-4 py-3 text-left text-gray-900">Price</th>
                          <th class="px-4 py-3 text-left text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="p in productsArr">
                          <td class="border px-4 py-2">{{ p.id }}</td>
                          <td class="border px-4 py-2">
                              <img class="h-24 w-24 rounded-lg object-cover object-center" :src="`/storage/${p.options.imageUrl}`">
                          </td>
                          <td class="border px-4 py-2">{{ p.name }}</td>
                          <td class="border px-4 py-2">Rs {{ p.price }}</td>
                          <td class="">
                            <div class="flex items-center">                                
                                <form @submit.prevent="updateCart(p)">
                                    <div class="flex flex-row items-center">
                                        <input class="px-4 py-3 w-16 text-center rounded-lg" type="text" name="" @input="qty = $event.target.value; selected = p.id"  :value="`${(selected == p.id) ? qty : p.qty}`">
                                        <button type="submit" class="p-3 rounded-lg text-blue-900 text-md ">
                                            Update
                                        </button>
                                    </div>
                                </form>
                                <form @submit.prevent="removeCart(p)">
                       
                                    <button class="p-3 rounded-lg text-blue-900 text-md ">
                                        <svg class="text-red-600 hover:shadow-md" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </form>
                            </div>
                          </td>
                        </tr>

                    </tbody>
                </table>

            </div>

            <div class="mt-6 mb-3 flex flex-col md:flex-row justify-between w-auto">
                <form @submit.prevent="redeemDiscount"> 
                    <div class="w-full md:w-auto mb-4 cm:mb-0">
                        <h3 class="mb-3 text-lg font-bold text-black">Redeem your Coupon</h3>
                        <div class="flex flex-col cm:flex-row items-center">
                            <input type="text" v-model="code" class="w-full cm:w-auto px-4 py-3 rounded-t-lg cm:rounded-l-lg bg-gray-100">
                            <button type="submit"  class="w-full md:w-auto px-4 py-3 rounded-b-lg cm:rounded-r-lg bg-black text-white font-bold text-lg" >
                                Redeem
                            </button>
                        </div>
                    </div>
                    
                </form>
                <div class="flex flex-col  rounded-lg p-3 mb-3">
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">SubTotal</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ subTotal }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Discount</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ discount }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">SubTotal After Discount</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ (subAfterDis) ? subAfterDis : subTotal }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Tax</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ tax }}</span>
                    </div>
                   
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Grand Total</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ grandTotal }}</span>
                    </div>
                </div>
                
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row items-center justify-end">
                <a :href="`/shoes`" class="w-full mt-2 order-1 md:order-0 mb-3 md:mb-0 md:w-auto md:mr-10 text-bold text-lg bg-gray-100 text-gray-900 p-3 rounded-lg text-center">Continue My Shopping</a>

                <a :href="`/checkout`" class="w-full ml-12 order-0 md:order-1 text-center md:w-auto text-bold text-lg bg-green-900 hover:bg-green-500 text-white p-3 rounded-lg">Checkout</a>
            </div>
        </div>
        <div v-else>
            <div class="flex items-center">
                <p class="text-medium font-semibold text-blue-500">Oh! My cart is empty.</p>
                <a :href="`/shoes`" class="ml-4 text-bold text-lg bg-green-900 text-white p-3 rounded-lg">Continue My Shopping</a>

            </div>
        </div>
        <!--Clear Cart Modal-->
        <div v-if="modal" class="fixed w-full h-full top-0 left-0 flex items-center justify-center"
        id="exampleModal" tabindex="-1" role="dialog"
        >
            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg overflow-y-auto max-w-lg rounded-lg p-6">
                <div class="flex justify-end rounded-t-lg">
                    <button @click="modal = false; " type="button" class="px-4 py-3 cursor-pointer" data-dismiss="modal" aria-label="Close">
                        <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </button>

                </div>
                <div class="">
                    <p class="px-2 py-2 text-lg mb-2"> Are you sure ? </p>
                </div>
                <div class="flex justify-end pt-2">
                  <button @click="modal = false; " class="px-4 cursor-pointer bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Cancel</button>
                  <button @click="clearCart" class="modal-close cursor-pointer px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'cart-view',
        props : ['products', 'cart', 'sub', 'dis', 'subAfterdis','tax', 'grand'],
        data(){
        	return {
                productsArr : [],
                code : '',
                qty: "",
                updatedQty : this.cart,
                subTotal : this.sub,
                discount : this.dis,
                subAfterDis : this.subAfterdis,
                tax : this.tax,
                grandTotal : this.grand,
                selected: null,
                status : false,
                message   : null,
                err       : null,
                modal :false,
        	}
        },
        mounted() {
            this.pushProducts();
        },
        methods: {
            pushProducts(){
                for (let [key, value] of Object.entries(this.products)) {
                    this.productsArr.push(value);
                }
            },
            updateCart(p){
    
                let qty = this.qty;
                axios.post(`/update-cart/${p.rowId}`, {
                    quantity : qty
                }).then(res => {

                    if(res.status == 200){
                        this.status = true;
                        serverBus.$emit('cart-updated',  { p, qty });  
                        this.message = 'Cart updated.';
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.rowId !== p.rowId;
                        });
                        this.productsArr.unshift({
                            id : p.id,
                            rowId : p.rowId,
                            name : p.name,
                            price : p.price,
                            qty : qty,
                            options: {
                                imageUrl : p.options.imageUrl
                            }
                        });
                        this.getUpdatedData();
                        this.removeMessage(); 
                    }
                    if(res.status == 204) {

                        serverBus.$emit('product-removed', p.qty);  
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
            removeCart(p){
                axios.post(`/remove-from-cart/${p.rowId}`)
                .then(res => {
                    if(res.status = 204){
                        serverBus.$emit('product-removed', p.qty);
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
            getUpdatedData(){
                axios.get('/getUpdatedData')
                .then(res => {
                    if(res.status == 200){
                        this.subTotal = res.data.subTotal;
                        this.tax = res.data.tax;
                        this.grandTotal = res.data.grand;
                        this.updatedQty = res.data.updatedQty;
                    }
                }).catch(err => {
                    this.status = false;
                    this.err = "There has been some error.";
                    this.removeMessage();
                });
            },
            clearCart(){
                axios.post('/clear-cart', {})
                .then(res => {
                    if(res.status == 204){
                        serverBus.$emit('cart-cleared');  
                        this.productsArr = [];
                        this.updatedQty = 0;
                        this.subTotal = 0;
                        this.grandTotal = 0;
                        this.status = true;
                        this.modal = false;
                        this.message = 'My cart has been cleared.';
                        this.removeMessage();
                    }
                }).catch(err => {
                    this.status = false;
                    this.err = "There has been some error.";
                    this.removeMessage();
                });
            },
            redeemDiscount(){
                let code = this.code;
                axios.post('/coupon-redeem', {
                    code : code
                })
                .then(res => {
                    let data = res.data;
                    if(res.status == 202){
                        this.status = true;
                        this.discount = data.discount;
                        this.subAfterDis = data.subAfterDis;
                        this.tax = data.tax;
                        this.grandTotal = data.grand;
                        this.message = data.message;
                        this.removeMessage();
                    } else if(res.status == 200){
                        this.status = false;
                        this.message = data.message;
                        this.removeMessage();
                    } else if(res.status == 204){
                        this.status = false;
                        this.message = 'Your coupon doesnot match.';
                        this.removeMessage();
                    }

                }).catch(err => {
                    this.status = false;
                    this.err = "There has been some error.";
                    this.removeMessage();
                });
            },  
            removeMessage(){
                setTimeout(() => {
                    this.message = null;
                    this.err = null;
                }, 3000);
            }
        }
    };
</script>
<style scoped>
    
</style>
