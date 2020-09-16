<template>
    <div class="w-full md:px-4">
        <!--- Product -->
        <div class="flex items-baseline">
            <a :href="`/admin/products`" class="mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6  text-gray-800">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            <h4 class="m-0 text-md font-bold ml-3">{{ product.name }} </h4>
        </div>d

        <!-- Product Details -->
        <div class="flex flex-col mb-4">
            <div class="flex-1 flex flex-col ml-2">
                <div class="flex items-center mb-2">
                    <span class="text-md font-md text-gray-800 w-40">Date</span>
                    <span class="text-lg font-lg text-gray-900">{{ format(product.created_at) }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-md font-md text-gray-800 w-40">Category</span>
                    <span class="text-lg font-lg text-gray-900">{{ category.name }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-md font-md text-gray-800 w-40">SubCategory</span>
                    <span class="text-lg font-lg text-gray-900">{{ subcategory.name }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-md font-md text-gray-800 w-40">Price</span>
                    <span class="text-lg font-lg text-gray-900">{{ product.price}}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="text-md font-md text-gray-800 w-40">Quantity</span>
                    <span class="text-lg font-lg text-gray-900">{{ product.qty}}</span>
                </div>
               
            </div>
        </div>

        <!-- Product Images -->
        <div class="w-full mb-4">
            <h4 class="m-0 text-md font-bold mb-4">Images</h4>

            <div class="grid grid-cols-1 cm:grid-cols-2 md:grid-cols-4 gap-4">
                <img v-for="image in images" class="w-full w-64 h-64 hover:shadow rounded-lg object-cover object-center" :src="`/${image.thumbnail}`" onerror="this.src='/img/placeholder.png'">
            </div>
        </div>

        <!-- Product Reviews -->
        <div class="w-full mb-4">
            <h4 class="m-0 text-md font-bold mb-4">Reviews</h4>

            <!-- Loop Reviews-->
            <div v-if="reviews.length > 0" class="flex flex-col">
                <div v-for="review in reviews" class="flex flex-row  mb-6">
                    <div class="flex flex-col mr-3 items-center ">
                        <img v-if="review.customer.avatar" class="w-12 md:w-16 object-center object-cover rounded-full" :src="`/storage/customers/${review.customer.avatar}`" onerror="this.src='/img/placeholder.png'">
                        <div v-else class="w-12 md:w-16  rounded-full text-transparent">ff</div>
                    </div>
                    <div class="flex flex-col ">
                        <div class="flex flex-col items-start mb-4">
                            <star-rating :rating="review.rating" :star-size="30" :rounded-corners="true" :show-rating="false" :read-only="true"></star-rating>
                            <h5 class="mt-2 text-sm font-light">{{ review.customer.first_name }}</h5>
                        </div>
                        <p class="text-md leading-6 font-semibold">{{ review.message }}</p>
                    </div>
                </div>
            </div>
            <!-- If Rviews Empty-->
            <div v-else class=" py-2 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-16 md:w-24 text-red-500 mb-40">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
                <p class="text-gray-900 text-xl py-3 text-left">No reviews received.</p>
            </div>
        </div>


    </div>
</template>
<script>
import { eventBus } from '../../../app.js';
import Toast from '../../helpers/Alert';
let dayjs = require('dayjs');

export default {
    name: 'show-product',
    props: {
        product  : {
            type     : Object,
            required : true
        }, 
        category  : {
            type     : Object,
            required : true
        }, 
        subcategory  : {
            type     : Object,
            required : true
        }, 
        images  : {
            type     : Array,
            required : true
        }, 
        reviews : {
            type     : Array,
            required : true
        }
    },
    data() {
        return {
            
        }
    },

    mounted() {
        this.pushToData();
    },
    methods: {
        pushToData() {
            
        },
        format(date) {
            return dayjs(date).format('dddd, MMMM D, YYYY');
        }
    }
};

</script>
<style>
@import "~vue-wysiwyg/dist/vueWysiwyg.css";

</style>
