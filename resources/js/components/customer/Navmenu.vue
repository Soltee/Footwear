<template>
    <div class="px-6 py-3  md:py-4 max-w-screen-lg mx-auto">
        <nav class=" flex flex-row justify-between items-center">
            <div class=" flex items-center">
                <svg v-if="!openMenu" @click="openMenu = true;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="relative  md:hidden w-8 h-8 text-custom-light-black cursor-pointer hover:opacity-75">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <a :href="`/`" class="ml-3 md:ml-0 text-lg font-semibold text-custom-light-black    no-underline mr-3">
                    <img class="h-8 w-8 text-custom-light-black" :src="`/img/logo.svg`">

                </a>
            </div>
            <!-- small screeen nav-->
            <div v-if="openMenu" class="fixed inset-0  px-6 py-6  md:hidden z-40 flex flex-col bg-custom-light-black  w-full ">
                <svg @click="openMenu = false;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-white cursor-pointer hover:opacity-75 mb-6">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                <path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z" /></svg>
                <li class="mb-4">
                    <a :href="`/shoes`" class="text-md text-white hover:opacity-75 hover:font-semibold">
                        Shoes
                    </a>
                </li>
                <li v-if="customer" class=" mb-4  ">
                    <a :href="`/dashboard`" class="mr-3">
                        <img v-if="customer.avatar" :src="`/storage/${customer.avatar}`" class="w-10 h-10 rounded-full object-cover object-center" onerror="this.src='/img/placeholder.png'">
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 rounded-full object-cover object-center text-white ">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                </li>
                <li v-if="customer" class=" mb-4  ">
                    <a :href="`/#`" @click.prevent="logoutModal = true;">
                        <svg <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8  text-white rounded-full">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </li>
                <li v-else class="mt-4 ">
                    <a href="/login" class="flex items-center justify-around  bg-custom-light-orange hover:bg-custom-dark-orange  px-6 py-3 rounded-lg">
                        <span class="text-white font-bold text-lg">Login</span>
                    </a>
                </li>
            </div>
            <!-- Large screeen nav-->
            <ul class="flex lex-row items-center mt-3">
                <li class="mb-4 mr-6">
                    <a :href="`/#`" @click.prevent="searchModal = true;">
                        <svg class=" w-6 h-6 cursor-pointer text-custom-light-black hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor" />
                        </svg>
                    </a>
                </li>
                <li class="relative flex items-center cursor-pointer mb-6 mr-6 mt-2">
                    <a :href="`/cart-details`">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-custom-light-black hover:text-gray-700">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span class="absolute top-0 right-0 -mt-2 -mr-2 text-custom-red-lighter p-1 bg-custom-gray rounded-full">{{ cartTotalQty }}</span>
                    </a>
                </li>
                <li class="mb-4 mr-6 hidden md:block">
                    <a :href="`/shoes`" class="text-md text-custom-light-black hover:text-gray-700 ">
                        Shoes
                    </a>
                </li>
                <li v-if="customer" class="flex  flex-row items-center mb-4 mr-6 mt-2 hidden md:block">
                    <a :href="`/dashboard`" class="mr-3">
                        <img v-if="customer.avatar" :src="`/storage/${customer.avatar}`" class="w-10 h-10 rounded-full object-cover object-center text-custom-light-black " onerror="this.src='https://via.placeholder.com/300'">
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 rounded-full object-cover object-center">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                </li>
                <li v-if="customer" class="flex  flex-row items-center mb-4 -mt-2 hidden md:block">
                    <a :href="`/#`" @click.prevent="logoutModal = true;">
                        <svg <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8  text-custom-light-black rounded-full">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                </li>
                <li v-else class="mt-2 mb-4 hidden md:block">
                    <a href="/login" class="flex items-center justify-around  bg-custom-light-orange hover:opacity-75  px-6 py-3 rounded-lg">
                        <span class="text-white font-semibold text-md">Login</span>
                    </a>
                </li>
            </ul>
            <!-- Logout Modal -->
            <div v-if="logoutModal" class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-40">
                <div @click="logoutModal = false" class="h-full w-full bg-white opacity-25">
                </div>
                <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
                    <div class="text-right">
                        <button type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-4 text-md font-semibold text-red-500 text-center">Are you sure? You want to logout ?</p>
                    <div class="mt-6 mb-3 flex justify-end">
                        <button @click="logoutModal = false" class="cursor-pointer text-custom-light-black px-4 py-3 rounded-lg mr-4">Discard</button>
                        <form id="logoutForm" class="" :method="`POST`" :action="`/customer-logout`">
                            <input type="hidden" name="_token" :value="`${csrf}`">
                            <button type="submit" class="cursor-pointer bg-red-600 hover:bg-red-500 text-white px-4 py-3 rounded">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Search Modal -->
            <div v-if="searchModal" class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-40 ">
                <div class="h-full w-full bg-gray-300" @click="shoesArray = []; keyword = ''; searchModal = false;">
                </div>
                <div class="absolute  bg-white left-0 right-0  mx-auto  h-full shadow-lg rounded-lg p-6 z-30">
                    <div class="text-right">
                        <button @click="shoesArray = []; keyword = ''; searchModal = false;" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="">
                        <form @submit.prevent="searchShoes">
                            <div class="mt-4 w-full flex flex-row">
                                <input v-focus v-model="keyword" type="text" class="focus:outline-none  w-2/3 bg-white rounded-l px-6 py-3 sm:mb-0 border" placeholder="Type shoes names..">
                                <button type="submit" class="focus:outline-none md:w-1/3  bg-custom-light-orange hover:opacity-75 rounded-r md:uppercase text-white font-bold md:tracking-wide py-3 px-3 md:px-6 text-center cursor-pointer">Search</button>
                            </div>
                        </form>
                        <h4 class="text-gray-800 font-semibold text-lg  mt-4">Search : {{ shoesArray.length }}</h4>
                        <div class="h-86 my-3 overflow-y-scroll">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 items-center gap-4">
                                <a v-for="s in shoesArray" class="mb-4 " :href="`/shoes/${s.id}/${s.name}`">
                                    <img class="w-full object-cover  rounded-lg" :src="`/storage/${s.imageUrl}`" onerror="this.src='https://via.placeholder.com/300'">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!--Categories-->
        <div v-if="name === 'welcome'">
            <categories />
        </div>

    </div>
</template>
<script>
import Toast from '../helpers/Alert.js';
import { eventBus } from '../../app.js';
import categories from './Categories';
export default {
    name: 'navmenu',
    props: ['customer', 'name'],
    directives: {
        focus: {
            // directive definition
            inserted: function(el) {
                el.focus();
            }
        }
    },
    components: {
        Toast, categories
    },
    data() {
        return {
            menuStatus: false,
            searchModal: false,
            logoutModal: false,
            openMenu: false,
            focus: false,
            keyword: '',
            searching: false,
            shoesArray: [],
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
            cartTotalQty: 0,
            grandTotal: 0,
            err: null
        }
    },
    mounted() {
        this.getCartProducts();
    },
    created() {
        eventBus.$on('product-added-to-cart', (qty) => {
            if (qty) {
                this.cartTotalQty += Number(qty);
            } else {
                this.cartTotalQty += 1;
            }
        });
        eventBus.$on('cart-updated', (p) => {
            this.cartTotalQty += (Number(p.qty) - p.p.qty);
        });
        eventBus.$on('product-removed', (qty) => {

            this.cartTotalQty -= qty;
        });
        eventBus.$on('cart-cleared', () => {
            // console.log('Yes');
            this.cartTotalQty = 0;
            this.products = [];
        });
    },
    methods: {
        searchShoes() {
            this.searching = true;
            axios.get(`/searchShoes/${this.keyword}`)
                .then(res => {
                    if (res.status == 200) {
                        this.shoesArray = res.data.shoes;
                        this.searching = false;
                    }
                }).catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: `Server error. Please try again.`
                    });
                });
        },
        async getCartProducts() {
            axios.get(`/getCartProducts`)
                .then((res) => {
                    if (res.status == 200) {
                        let data = res.data;
                        if (data.totalQty > 0) {
                            this.cartTotalQty = res.data.totalQty;
                            this.products = data.cartProducts;
                            this.grandTotal = data.grandTotal;
                        }
                    }
                }).catch(error => this.err = 'There has been some error.');
        }
    }
};

</script>
<style scoped>
</style>
