<template>
    <div class="relative  z-0 flex flex-col  " :class="(modal) ? 'bg-gray-400' : ''">
        <div v-if="updatedQty > 0" class="">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a :href="`/shoes`" class=" text-md md:text-lg text-indigo-900">Shoes</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                    <h4 class="font-semibold  text-md md:text-lg text-gray-900">Cart</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-700 mx-2">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                    <h4 class=" text-md md:text-lg text-gray-900 opacity-75">Checkout</h4>
                </div>
                <!-- <form @submit.prevent="clearCart"> -->
                <button @click="modal = true;" type="submit" class="p-3 bg-red-500 rounded-lg text-lg font-medium text-white">Empty Cart

</button>
                <!-- </form> -->
            </div>
            <div class="mt-6 overflow-x-scroll  border-b border-gray-200 sm:rounded-lg">
                <table class=" min-w-full  table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                            <th class="px-6 py-3 text-left text-gray-900">Image</th>
                            <th class="px-6 py-3 text-left text-gray-900">Name</th>
                            <th class="px-6 py-3 text-left text-gray-900">Price</th>
                            <th class="px-6 py-3 text-left text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in productsArr">
                            <td class=" px-6 py-3  whitespace-no-wrap">
                                <img class="h-24 w-24 rounded-lg object-cover object-center" :src="`/storage/${p.options.imageUrl}`">
                            </td>
                            <td class=" px-6 py-3  whitespace-no-wrap">{{ p.name }}</td>
                            <td class=" px-6 py-3  whitespace-no-wrap">Rs {{ p.price }}</td>
                            <td class="px-6 py-3 whitespace-no-wrap">
                                <div class="flex items-center">
                                    <form @submit.prevent="updateCart(p)">
                                        <div class="flex flex-row items-center">
                                            <input class="px-4 py-3 w-16 text-center rounded-lg border" type="text" name="" @input="qty = $event.target.value; selected = p.id" :value="`${(selected == p.id) ? qty : p.qty}`">
                                            <button type="submit" class="p-3 rounded-lg text-blue-900 text-md ">
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                    <form @submit.prevent="removeCart(p)">
                                        <button class="p-3 rounded-lg text-blue-900 text-md ">
                                            <svg class="text-red-600 hover:shadow-md" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-6 mb-3 flex flex-col md:flex-row justify-end w-auto">
                <!-- <form @submit.prevent="redeemDiscount"> 
                    <div class="w-full md:w-auto mb-4 cm:mb-0">
                        <h3 class="mb-3 text-lg font-bold text-black">Redeem your Coupon</h3>
                        <div class="flex flex-col cm:flex-row items-center">
                            <input type="text" v-model="code" class="w-full cm:w-auto px-4 py-3 rounded-t-lg cm:rounded-l-lg bg-gray-100">
                            <button type="submit"  class="w-full md:w-auto px-4 py-3 rounded-b-lg cm:rounded-r-lg bg-black text-white font-bold text-lg" >
                                Redeem
                            </button>
                        </div>
                    </div>
                    
                </form> -->
                <div class="flex flex-col  rounded-lg md:p-3 mb-3">
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
                <a :href="`/shoes`" class="w-full mt-2 order-1 md:order-0 mb-6 md:mb-0 md:w-auto md:mr-16  text-md bg-gray-100 text-gray-900 px-4 py-3 rounded-lg text-center">Continue Shopping</a>
                <a :href="`/checkout`" class="w-full md:ml-12 order-0 md:order-1 text-center md:w-auto text-bold text-md bg-custom-light-orange hover:opacity-75 text-white px-4 py-3 rounded-lg">Checkout</a>
            </div>
        </div>
        <div v-else>
            <div class="flex items-center">
                <p class="text-medium font-semibold text-blue-500">Oh! My cart is empty.</p>
                <a :href="`/shoes`" class="ml-4 text-bold text-lg bg-green-900 text-white p-3 rounded-lg">Continue My Shopping</a>
            </div>
        </div>
        <!--Clear Cart Modal-->
        <div v-if="modal" class="fixed w-full h-full top-0 left-0 flex items-center justify-center" id="exampleModal" tabindex="-1" role="dialog">
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
import Toast from '../helpers/Alert';
import { eventBus } from '../../app.js';
export default {
    name: 'cart-view',
    props: ['products', 'cart', 'sub', 'dis', 'subafterdis', 'taxadded', 'grand'],
    data() {
        return {
            productsArr: [],
            code: '',
            qty: "",
            updatedQty: this.cart,
            subTotal: this.sub,
            discount: this.dis,
            subAfterDis: this.subafterdis,
            tax: this.taxadded,
            grandTotal: this.grand,
            selected: null,
            status: false,
            message: null,
            err: null,
            modal: false,
        }
    },
    mounted() {
        this.pushProducts();
    },
    methods: {
        pushProducts() {
            for (let [key, value] of Object.entries(this.products)) {
                this.productsArr.push(value);
            }
        },
        updateCart(p) {

            let qty = this.qty;
            axios.post(`/update-cart/${p.rowId}`, {
                    quantity: qty
                }).then(res => {

                    if (res.status == 200) {
                        this.status = true;
                        eventBus.$emit('cart-updated', { p, qty });
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.rowId !== p.rowId;
                        });
                        this.productsArr.unshift({
                            id: p.id,
                            rowId: p.rowId,
                            name: p.name,
                            price: p.price,
                            qty: qty,
                            options: {
                                imageUrl: p.options.imageUrl
                            }
                        });
                        this.getUpdatedData();
                        Toast.fire({
                            icon: 'success',
                            title: `Item has been updated from my cart.`
                        });
                    }
                    if (res.status == 204) {

                        eventBus.$emit('product-removed', p.qty);
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
                        this.getUpdatedData();
                        this.status = false;
                        Toast.fire({
                            icon: 'success',
                            title: `Item has been removed from my cart.`
                        });
                    }
                })
                .catch(err => {
                    this.status = false;
                    Toast.fire({
                        icon: 'error',
                        title: `There has been server error. Please try again.`
                    });
                });
        },
        removeCart(p) {
            axios.post(`/remove-from-cart/${p.rowId}`)
                .then(res => {
                    if (res.status = 204) {
                        eventBus.$emit('product-removed', p.qty);
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
                        this.getUpdatedData();
                        this.status = true;
                        Toast.fire({
                            icon: 'success',
                            title: `Item has been removed from my cart.`
                        });
                    }
                }).catch(err => {
                    this.status = false;
                    Toast.fire({
                        icon: 'error',
                        title: `There was some server error.`
                    });
                });
        },
        getUpdatedData() {
            axios.get('/getUpdatedData')
                .then(res => {
                    if (res.status == 200) {
                        this.subTotal = res.data.subTotal;
                        this.tax = res.data.tax;
                        this.grandTotal = res.data.grand;
                        this.updatedQty = res.data.updatedQty;
                    }
                }).catch(err => {
                    this.status = false;
                    Toast.fire({
                        icon: 'error',
                        title: `There was some server error.`
                    });
                });
        },
        clearCart() {
            axios.post('/clear-cart', {})
                .then(res => {
                    if (res.status == 204) {
                        eventBus.$emit('cart-cleared');
                        this.productsArr = [];
                        this.updatedQty = 0;
                        this.subTotal = 0;
                        this.grandTotal = 0;
                        this.status = true;
                        this.modal = false;
                        Toast.fire({
                            icon: 'success',
                            title: `There was some server error.`
                        });
                    }
                }).catch(err => {
                    this.status = false;
                    Toast.fire({
                        icon: 'error',
                        title: `There was some server error.`
                    });
                });
        },
        redeemDiscount() {
            let code = this.code;
            axios.post('/coupon-redeem', {
                    code: code
                })
                .then(res => {
                    let data = res.data;
                    if (res.status == 201) {
                        this.status = true;
                        this.discount = data.discount;
                        this.subAfterDis = data.subAfterDis;
                        this.tax = data.tax;
                        this.grandTotal = data.grand;
                        Toast.fire({
                            icon: 'success',
                            title: `My coupon is successfully redeemed.`
                        });
                    } else if (res.status == 200) {
                        this.status = false;
                        Toast.fire({
                            icon: 'error',
                            title: `My coupon has already been redeemed.`
                        });
                    } else if (res.status == 204) {
                        this.status = false;
                        Toast.fire({
                            icon: 'error',
                            title: `My coupon doesnot match.`
                        });
                    }

                }).catch(err => {
                    this.status = false;
                    Toast.fire({
                        icon: 'error',
                        title: `There was some server error.`
                    });
                });
        },
        removeMessage() {
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
