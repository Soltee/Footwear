<template>
    <div class="fixed inset-0 bg-white  rounded-lg  py-4 px-4 z-20  w-screen overflow-x-hidden">
            <div class="mb-3 text-right">
                <button @click="closeModal" type="button" class="px-4 py-2 cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>
            </div>
            <!--- Product TYPE -->
            <div v-if="type == 'product'" class="overflow-y-scroll h-full">
                <div class="flex flex-col md:flex-row justify-around items-center">
                    <div class="flex-1 flex flex-col ml-2">
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Date</span>
                            <span class="text-lg font-lg text-gray-900">{{ format(item.created_at) }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Name</span>
                            <span class="text-lg font-lg text-gray-900">{{ item.name}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Price</span>
                            <span class="text-lg font-lg text-gray-900">{{ item.price}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Quantity</span>
                            <span class="text-lg font-lg text-gray-900">{{ item.qty}}</span>
                        </div>
                        <div class="flex items-center mb-3">
                            <a class="text-blue-500 hover:opacity-75" :href="`/admin/reviews/${item.id}`">
                                <span class="text-md font-md text-gray-800 w-40">Reviews</span>
                            </a>
                            <a class="text-blue-500 hover:opacity-75" :href="`/admin/reviews/${item.id}`">
                                <span class="text-lg font-lg text-gray-900">{{ reviews}}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class=" w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3">
                        <img v-for="image in images" class="w-full w-64 h-64 hover:shadow rounded-lg object-cover object-center" :src="`/${image.imageUrl}`" onerror="this.src='/img/placeholder.png'" >
                    </div>
                </div>
            </div>
            <!--- Customer TYPE -->
            <div v-if="type == 'customer'" class="">
                <div class="flex flex-col md:flex-row w-full items-center">
                    <div v-if="customer">
                        <img :src="`/storage/${customer.avatar}`" class="w-40 h-40 rounded-full object-cover object-center" onerror="this.src='/img/placeholder.png'">
                    </div>
                    <div v-else>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-40 h-40 rounded-full object-cover object-center">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 flex flex-col mt-3 md:mt-0 md:ml-5">
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Date</span>
                            <span class="text-lg font-lg text-gray-900">{{ format(customer.created_at) }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Name</span>
                            <span class="text-lg font-lg text-gray-900">{{ customer.name}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Email</span>
                            <span class="text-lg font-lg text-gray-900">{{ customer.email}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Registered At</span>
                            <span class="text-lg font-lg text-gray-900">{{ format(customer.created_at) }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-3 flex flex-col overflow-y-scroll w-full">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-white rounded-lg">
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Date</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Name</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Email</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Phone</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">City</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Address</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">SubTotal</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Discount</th>
                                <th class="px-4 py-3 whitespace-no-wrap text-left text-gray-900">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="customer_order.length > 0" v-for="order in customer_order">
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">{{ format(order.created_at) }}</td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">{{ order.first_name}} {{order.last_name}}</td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900"> {{order.email}}</td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">{{ order.phoneNumber }} </td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">{{ order.city }} </td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">{{ order.street_address }} </td>

                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">Rs {{ order.subtotal}}</td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">Rs {{ order.discount }}</td>
                                <td class="whitespace-no-wrap px-3 py-3 text-lg font-lg text-gray-900">Rs {{ order.grand }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <!--- order -->
            <div v-if="type == 'order'" class="overflow-y-scroll">
                <div class="mb-3 md:mb-0 flex flex-col md:flex-row justify-around items-center">
                    <div v-if="customer">
                        <img :src="`/storage/${customer.avatar}`" class="w-12 h-12 md:w-40 md:h-40 rounded-full object-cover object-center" onerror="this.src='/img/placeholder.png'">
                    </div>
                    <div v-else>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 md:w-40 md:h-40 rounded-full object-cover object-center">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <div class="flex-1 flex flex-col ml-2">
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Date</span>
                            <span class="text-lg font-lg text-gray-900">{{ format(order.created_at) }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Name</span>
                            <span class="text-lg font-lg text-gray-900">{{ order.first_name}} {{order.last_name}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Email</span>
                            <span class="text-lg font-lg text-gray-900">{{ order.first_name}} {{order.email}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Phone</span>
                            <span class="text-lg font-lg text-gray-900">{{ order.phoneNumber }} </span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">City</span>
                            <span class="text-lg font-lg text-gray-900">{{ order.phoneNumber }} </span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Street Address</span>
                            <span class="text-lg font-lg text-gray-900">{{ order.street_address }} </span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Sub Total</span>
                            <span class="text-lg font-lg text-gray-900">Rs {{ order.subtotal}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Discount</span>
                            <span class="text-lg font-lg text-gray-900">Rs {{ order.discount}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Subtotal After Discount</span>
                            <span class="text-lg font-lg text-gray-900">Rs {{ order.subafterdiscount}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Tax</span>
                            <span class="text-lg font-lg text-gray-900">Rs {{ order.tax}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Grand Total</span>
                            <span class="text-lg font-lg text-gray-900">Rs {{ order.grand}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Completed</span>
                            <span class="text-lg font-lg text-gray-900">{{ format(order.created_at) }}</span>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-scroll min-w-64 mt-6 md:overflow-hidden md:w-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-white rounded-lg">
                                <th class="px-4 py-3 text-left text-gray-900">Name</th>
                                <th class="px-4 py-3 text-left text-gray-900">Price</th>
                                <th class="px-4 py-3 text-left text-gray-900">Quantity</th>
                                <th class="px-4 py-3 text-left text-gray-900">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="orderItems.length > 0" v-for="item in orderItems">
                                <td class="border px-4 py-2 text-gray-900">{{ item.name }}</td>
                                <td class="border px-4 py-2 text-gray-900">Rs {{ item.price }}</td>
                                <td class="border px-4 py-2 text-gray-900">{{ item.quantity }}</td>
                                <td class="border px-4 py-2 text-gray-900">Rs {{ (item.price * item.quantity) }}</td>
                            </tr>
                            <tr v-else>
                                <td class="border px-4 py-2 text-gray-900">Sorry No Orders Items</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</template>
<script>
import { eventBus } from '../../../app.js';
import Toast from '../../helpers/Alert';
let dayjs = require('dayjs');
export default {
    name: 'ViewModal',
    props: ['type', 'data'],
    components: {
        Toast
    },
    data() {
        return {
            customer: {},
            customer_order: [],
            order: {},
            orderItems: {},
            item: {},
            images: [],
            reviews: 0
        }
    },
    mounted() {
        let endpoint = '/admin';

        if (this.type == 'product') {
            endpoint += `/products/${this.data.id}`;
        } else if (this.type == 'customer') {
            endpoint += `/customers/${this.data.id}`;
        } else if (this.type == 'order') {
            endpoint += `/orders/${this.data.id}`;
        }

        axios.get(`${endpoint}`)
            .then(res => {
                let data = res.data
                if (res.status == 200) {
                    if (this.type == 'product') {
                        this.item = data.product;
                        this.images = data.images;
                        this.reviews = data.reviews;
                    } else if (this.type == 'customer') {
                        this.customer = data.customer;
                        this.customer_order = data.orders;
                    } else if (this.type == 'order') {
                        this.order = data.order;
                        this.customer = data.customer;
                        this.orderItems = data.orders_items;
                    }

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Network Error!'
                    });
                }
            }).catch(err => {
                Toast.fire({
                    icon: 'error',
                    title: 'Network Error!'
                });
            });



    },
    methods: {
        closeModal() {
            eventBus.$emit('close-modal');
        },
        format(date) {
            return dayjs(date).format('dddd, MMMM D, YYYY');
        }
    }
};

</script>
<style>
</style>
