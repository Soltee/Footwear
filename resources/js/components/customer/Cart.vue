<template>
    <div class="relative  z-0 flex flex-col  " :class="(modal) ? 'opacity-75' : ''">
        <div v-if="updatedQty > 0" class="">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a :href="`/shoes`" class=" text-md md:text-lg text-custom-light-black">Shoes</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                    <h4 class="font-semibold  text-md md:text-lg text-custom-light-black">Cart</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-700 mx-2 hidden md:block">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                    <h4 class=" text-md md:text-lg text-custom-light-black opacity-75 hidden md:block">Checkout</h4>
                </div>
                <!-- <form @submit.prevent="clearCart"> -->
                <button @click="modal = true;" type="submit" class="px-3 py-3  flex items-center justify-around rounded-lg text-lg font-medium text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-red-600  hover:text-red-500">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    <span class="text-red-600 ml-3 hover:text-red-500">Empty Cart</span>
                </button>
                <!-- </form> -->
            </div>
            <div class="mt-6 overflow-x-scroll md:overflow-x-auto  border-b border-gray-200 sm:rounded-lg">
                <table class=" min-w-full  table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                            <th class="px-6 py-3 text-left text-custom-light-black">Image</th>
                            <th class="px-6 py-3 text-left text-custom-light-black">Name</th>
                            <th class="px-6 py-3 text-left text-custom-light-black">Price</th>
                            <th class="px-6 py-3 text-left text-custom-light-black">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in productsArr">
                            <td class=" px-6 py-3  whitespace-no-wrap">
                                <img class="h-24 w-24 rounded-lg object-cover object-center" :src="`/storage/${p.options.imageUrl}`" onerror="this.src='https://via.placeholder.com/300'">
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
            <div class="mt-6 mb-3 flex flex-col md:flex-row ">
                <div class="flex-1">
                    <form @submit.prevent="redeemDiscount">
                        <div class="w-full md:w-auto mb-4 cm:mb-0">
                            <h3 class="mb-3 text-lg font-bold text-black">Have a Coupon?</h3>
                            <div class="mt-4 w-full flex flex-col md:flex-row">
                                <input v-model="code" type="text" class="focus:outline-none  w-full md:w-2/3 bg-white rounded-t md:rounded-t-none md:rounded-l px-6 py-2 sm:mb-0 border focus:border-custom-light-orange" placeholder="Enter Coupon..">
                                <button type="submit" class="focus:outline-none w-full md:w-1/3  bg-custom-light-orange hover:opacity-75 rounded-b md:rounded-b-none md:rounded-r md:uppercase text-white font-bold md:tracking-wide py-2 px-3 md:px-6 text-center cursor-pointer">Apply</button>
                            </div>
                            <!-- <div class="flex flex-col md:flex-row items-center">
                                <input type="text" v-model="code" class="w-full md:w-auto px-4 py-3 border border-gray-300 rounded-t-lg md:rounded-l-lg">
                                <button type="submit" class="w-full md:w-auto px-4 py-3 rounded-b-lg md:rounded-r-lg bg-custom-light-black hover:opacity-50 text-white font-bold text-lg">
                                    Apply
                                </button>
                            </div> -->
                        </div>
                    </form>
                </div>
                <div class="w-full sm:w-400 md:w-500 mt-5 md:mt-0 flex flex-col  rounded-lg md:p-3 mb-3">
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">SubTotal</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ subTotal }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Discount {{ percent }} </span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">{{ discount }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">SubTotal After Discount</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">{{ (subAfterDis) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Tax</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ tax }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Grand Total</span>
                        <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ grandTotal }}</span>
                    </div>
                    <div class="mt-5  flex flex-col md:flex-row justify-between items-center ">
                        <a :href="`/shoes`" class="w-full mt-3 md:mt-0 order-1 md:order-0 mb-6 md:mb-0 md:w-auto   text-md  text-custom-light-black hover:opacity-75 px-4 py-4 rounded-lg text-center">Continue Shopping</a>
                        <a :href="`/checkout`" class="w-full  order-0 md:order-1 text-center md:w-auto text-bold text-md bg-custom-light-orange hover:opacity-75 text-white px-6 py-4 rounded-lg">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="flex items-center w-full flex-col">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 md:h-24 md:w-24 text-red-500">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
                <p class="text-sm font-semibold text-red-500 mt-4">Oh! My cart is empty.</p>
                <a :href="`/shoes`" class="w-full mt-4 text-center md:w-auto text-bold text-md bg-custom-light-orange hover:opacity-75 text-white px-6 py-4 rounded-lg">Continue Shopping</a>
            </div>
        </div>
        <!--Clear Cart Modal-->
        <div v-if="modal" class="fixed w-full h-full top-0 left-0 flex items-center justify-center" id="exampleModal" tabindex="-1" role="dialog">
            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg overflow-y-auto max-w-lg rounded-lg p-6">
                <div class="flex justify-end rounded-t-lg">
                    <button @click="modal = false; " type="button" class="px-4 py-3 cursor-pointer" data-dismiss="modal" aria-label="Close">
                        <svg class="fill-current text-custom-light-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </button>
                </div>
                <div class="">
                    <p class="px-2 py-2 text-lg mb-2 text-red 500 text-center"> Are you sure ? </p>
                </div>
                <div class="flex justify-end pt-2">
                    <button @click="modal = false; " class="px-4 cursor-pointer bg-transparent p-3 rounded-lg text-red-600 hover:bg-red-500 hover:text-indigo-400 mr-2">Cancel</button>
                    <button @click="clearCart" class="modal-close cursor-pointer px-4 bg-red-600 p-3 rounded-lg text-white hover:bg-red-500" data-dismiss="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Toast from '../helpers/Alert';
import swal from 'sweetalert';
import { eventBus } from '../../app.js';
export default {
    name: 'cart-view',
    props: ['products', 'cart', 'per', 'sub', 'dis', 'subafterdis', 'taxadded', 'grand'],
    data() {
        return {
            productsArr: [],
            code: '',
            qty: "",
            updatedQty: this.cart,
            subTotal: this.sub,
            percent: '',
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
        if (this.per > 0) {
            this.percent = `${this.per}% off`;
        } else {
            this.percent = '';
        }
        if (this.dis > 0) {
            this.discount = `$ ${this.dis}`;
        } else {
            this.discount = '0';
        }

        if (this.subafterdis > 0) {
            this.subAfterDis = `$ ${this.subafterdis}`;
        } else {
            this.subAfterDis = '0';
        }
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

                        swal({
                            title: "Success!",
                            text: "Item has been updated in the cart!",
                            icon: "success",
                            button: "Close",
                        });
                    }
                    if (res.status == 204) {

                        eventBus.$emit('product-removed', p.qty);
                        this.productsArr = this.productsArr.filter((state) => {
                            return state.id !== p.id;
                        });
                        this.getUpdatedData();
                        this.status = false;

                        swal({
                            title: "Success!",
                            text: "Item has been removed from the cart!",
                            icon: "success",
                            button: "Close",
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
                        swal({
                            title: "Success!",
                            text: "Item has been removed from the cart!",
                            icon: "success",
                            button: "Close",
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
                        this.percent = `${res.data.percent}% off`;
                        this.discount = `$ ${res.data.discount}`;
                        this.subAfterDis = `$ ${res.data.subAfterDis}`;
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
                        this.percent = '';
                        this.updatedQty = 0;
                        this.subTotal = 0;
                        this.grandTotal = 0;
                        this.status = true;
                        this.modal = false;

                        swal({
                            title: "Success!",
                            text: "You cart is cleared!",
                            icon: "success",
                            button: "Close",
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
            if(this.code === '') {;
                swal({
                    title: "Oops!",
                    text: " You may have incorrect coupon.",
                    icon: "warning",
                    button: "Close",
                });
                return;
            }

            let code = this.code;
            axios.post('/coupon-redeem', {
                    code: code
                })
                .then(res => {
                    let data = res.data;
                    if (res.status == 201) {

                        //Set the Updated Cart Data
                        this.status = true;
                        this.percent = `${data.percent}% off`;
                        this.discount = `$ ${data.discount}`;
                        this.subAfterDis = `$ ${data.subAfterDis}`;
                        this.tax = data.tax;
                        this.grandTotal = data.grand;

                        //Reset The Form
                        this.code = '';

                        swal({
                            title: "Success!",
                            text: "Your coupon has been successfully applied!",
                            icon: "success",
                            button: "Close",
                        });
                    } else if (res.status == 200) {

                        //If Coupon has already been applied;
                        this.status = false;

                        swal({
                            title: "",
                            text: "Your coupon has been already applied!",
                            icon: "warning",
                            button: "Close",
                        });
                    } else if (res.status == 204) {
                        //If Couon Doesnot matcch;
                        this.status = false;
                        
                        swal({
                            title: "Oops!",
                            text: `Your coupon doesnot match one of ours.`,
                            icon: "warning",
                            button: "Close",
                        });
                    }

                }).catch(err => {
                    this.status = false;

                    // Toast.fire({
                    //     icon: 'error',
                    //     title: `There was some server error.Please try again later.`
                    // });
                    if (err.data.errors.code) {
                        swal({
                            title: "Oops!",
                            text: `${err.data.errors.code}.`,
                            icon: "warning",
                            button: "Close",
                        });
                      
                    }
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
