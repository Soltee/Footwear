<template>
    <div class=" flex flex-col items-left   rounded-lg p-2 md:p-0 z-20 md:mt-0  md:static md:flex-row   md:items-center md:text-right md:rounded-none">

       <search></search>
        
        <li class="relative mb-3 md:mb-0 md:ml-4 md:mr-8 ">
            <!-- <span class=?"relative text-custom-gray hover:opacity-75"> -->
                <div class="flex flex-row justify-between items-center">
                    <a href="/shoes">
                        <h4 class="text-lg text-custom-gray font-bold">Shoes</h4>
                    </a>
                    <svg v-if="megaMenustatus" @click="megaMenustatus = false" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg>
                    <svg v-else @click="megaMenustatus = true" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
                <div v-if="megaMenustatus" class="md:absolute  p-3 mt-4 rounded-lg top-0 right-0  w-64">
                    <div class=" bg-black flex flex-col md:flex-row justify-around">
                        
                    <div v-for="category in categories" class="mt-6 md:mr-10 flex flex-col items-left rounded-lg">
                        <a :href="`/shoes?id=${category.id}&category=${category.name}`" class="text-custom-gray hover:opacity-75 md:mr-10">
                            <h4 class="text-lg text-gray-light font-bold mb-4">{{ category.name }}</h4>
                        </a>
                        <ul v-for="subcategory in category.subcategories" class="flex flex-col items-left md:mr-10">
                            <li class="mb-2">
                                <a :href="`/shoes?id=${subcategory.id}&subcategory=${subcategory.name}`" class="text-custom-gray hover:opacity-75">

                                    {{subcategory.name}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    </div>
                    
                </div>
            <!-- </span> -->
        </li>
        <li class="mb-4 md:mb-0 ">
            <a href="" class="text-custom-gray hover:opacity-75">
                Company
            </a>
        </li>
        <div class="mx-6">
            <cartQty ></cartQty>
        </div>
        <div v-if="customer" class="relative md:mb-0  flex flex-col">
            <div class="flex items-center justify-around w-full md:w-32 px-2 py-1 bg-custom-gray-lighter " :class="(userStatus) ? 'rounded-t-lg' : 'rounded-full'">
                <img class="h-8 w-8 p-1 text-white bg-white rounded-full" :src="customer.avatar ? `/storage/${customer.avatar}` : `/svg/avatar.svg`">
                <svg v-if="userStatus" @click="userStatus = false" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg>
                <svg v-else @click="userStatus = true" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
            <div v-if="userStatus" class="absolute top-0 left-0 md:right-0 mt-10 bg-custom-gray-lighter px-2 py-1 rounded-b-lg w-full md:w-32 flex  flex-col border-gray-300 border-t-2">
                <a href="/dashboard" class="mt-2 flex items-left mb-2 no-underline">
                    <svg class="h-6 w-6 text-custom-gray cursor-pointer hover:text-custom-gray-light" viewBox="0 0 30 30" fill="" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="13.6" stroke="white" stroke-width="2.8"/>
                        <path d="M11.3132 18.3167C11.3132 17.7627 10.8383 17.3135 10.2526 17.3135C9.66677 17.3135 9.19189 17.7627 9.19189 18.3167V22.3298C9.19189 22.8839 9.66677 23.3331 10.2526 23.3331C10.8383 23.3331 11.3132 22.8839 11.3132 22.3298V18.3167Z" fill="white"/>
                        <path d="M15.2019 13.6349C15.2019 13.0808 14.727 12.6316 14.1412 12.6316C13.5554 12.6316 13.0806 13.0808 13.0806 13.6349V22.3298C13.0806 22.8839 13.5554 23.3331 14.1412 23.3331C14.727 23.3331 15.2019 22.8839 15.2019 22.3298V13.6349Z" fill="white"/>
                        <path d="M14.7014 9.29798C15.0904 8.88373 15.0507 8.24961 14.6128 7.88162C14.1749 7.51364 13.5044 7.55115 13.1154 7.9654L7.37127 14.0818C6.98223 14.496 7.02188 15.1302 7.45983 15.4981C7.89778 15.8661 8.56818 15.8286 8.95722 15.4144L14.7014 9.29798Z" fill="white"/>
                        <path d="M16.1622 12.2425C16.5793 12.6315 17.2509 12.6269 17.6621 12.2323C18.0734 11.8377 18.0686 11.2025 17.6514 10.8135L14.618 7.98513C14.2008 7.59615 13.5292 7.60071 13.118 7.99531C12.7068 8.38991 12.7116 9.02512 13.1288 9.4141L16.1622 12.2425Z" fill="white"/>
                        <path d="M16.2438 10.7756C15.8637 11.1972 15.917 11.8304 16.3628 12.1899C16.8086 12.5494 17.478 12.499 17.8581 12.0774L20.8737 8.73167C21.2538 8.31002 21.2005 7.67679 20.7547 7.31731C20.3089 6.95783 19.6395 7.00822 19.2594 7.42986L16.2438 10.7756Z" fill="white"/>
                        <path d="M19.4923 8.68639C19.4662 8.13282 19.9195 7.66413 20.5047 7.63948L20.7244 7.63022C20.9195 7.62199 21.0847 7.76493 21.0933 7.94943L21.1873 9.94402C21.2073 10.3704 20.8581 10.7315 20.4073 10.7505C19.9565 10.7695 19.5748 10.4392 19.5547 10.0128L19.4923 8.68639Z" fill="white"/>
                        <path d="M19.9053 7.05488C20.4171 6.99495 20.8834 7.3388 20.9468 7.82294C20.9943 8.18603 20.7216 8.5168 20.3378 8.56175L17.8018 8.85875C17.354 8.91119 16.946 8.61031 16.8906 8.18673C16.8351 7.76312 17.1532 7.37719 17.601 7.32476L19.9053 7.05488Z" fill="white"/>
                        <path d="M19.4441 16.3101C19.4441 15.7561 18.9692 15.3069 18.3834 15.3069C17.7976 15.3069 17.3228 15.7561 17.3228 16.3101V22.3297C17.3228 22.8838 17.7976 23.333 18.3834 23.333C18.9692 23.333 19.4441 22.8838 19.4441 22.3297V16.3101Z" fill="white"/>
                        <path d="M23.3337 10.9593C23.3337 10.4052 22.8589 9.95605 22.2731 9.95605C21.6873 9.95605 21.2124 10.4052 21.2124 10.9593V22.3297C21.2124 22.8837 21.6873 23.3329 22.2731 23.3329C22.8589 23.3329 23.3337 22.8837 23.3337 22.3297V10.9593Z" fill="white"/>
                        </svg>

                    <span class="text-custom-gray ml-2">Dashboard</span>
                </a>
                <a href="/customer-profile" class="mt-2 flex items-left mb-2 no-underline">
                    <svg class="h-6 w-6 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.3 3.7l4 4L4 20H0v-4L12.3 3.7zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg>
                    <span class="text-custom-gray ml-2">Profile</span>
                </a>
                <a href="/customer-logout"
                   class="flex items-left no-underline text-custom-gray text-lg"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <svg class="h-6 w-6 text-custom-gray cursor-pointer hover:text-custom-gray-light"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/></svg>
                    <span class="text-custom-gray ml-2">Logout</span>
                </a>
                <form id="logout-form" action="/customer-logout" method="POST" class="hidden">
                    <input type="hidden" name="_token" :value="csrf">
                </form>
            </div>
        </div>
        <div v-else>
            <li class="ml-6">
                <a href="/login" class="flex items-center content-between bg-custom-red-darker hover:bg-custom-red-lighter  px-8 py-1 rounded-full">
                    <svg class="w-8 h-8 text-custom-gray" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"/></svg>
                    <span class="text-custom-gray ml-3 font-bold text-lg">Login</span>
                </a>
            </li>
        </div>
          

    </div>
</template>

<script>
import search from './Search';
import cartQty from './CartQty';
import request from '../../helpers.js';

    export default {
        name : 'ListItems',
        props : ['customer'],
        components: {
            search, cartQty
        },
        data(){
        	return {
                userStatus : false,
                menuStatus : false,
                megaMenustatus: false,
                categories : null,
                err        : null,
                csrf       : document.head.querySelector('meta[name="csrf-token"]').content
        	}
        },
        mounted() {
            this.getCategories();
        },
        methods: {
            getCategories(){
                console.log(request);
                request('/categories').then(res => {
                    if(res.status = 200){
                        this.categories = res.data.categories;
                    }
                }).catch((err) => {
                    this.err = err.data;
                });
            }
        }
    }
</script>
<style scoped>
    .translateHide{
        transition: transform 0.3s;
        transform: translateX(100%);
    }
    .translateShow{
        transform: translateX(0);
    }
</style>
