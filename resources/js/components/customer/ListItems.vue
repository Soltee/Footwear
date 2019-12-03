<template>
    <div class=" flex flex-col items-left   bg-black rounded-lg p-2 md:p-0 z-20 md:mt-0  md:static md:flex-row md:items-center md:text-right md:rounded-none">

       <search></search>
        
        <li class="relative mb-3 md:mb-0 md:ml-4">
            <span class="relative text-custom-gray hover:opacity-75">
                <div class="flex flex-row justify-between items-center">
                    <a href="/shoes">
                        <h4 class="text-lg text-custom-gray font-bold">Shoes</h4>
                    </a>
                    <svg v-if="megaMenustatus" @click="megaMenustatus = false" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg>
                    <svg v-else @click="megaMenustatus = true" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
                <div v-if="megaMenustatus" class="md:absolute bg-black p-3 rouneded-lg top-0 right-0 m-0 md:mt-10 ml-0 flex flex-col md:flex-row justify-around">
                    <div class="md:mr-6">
                        <h4 class="text-lg text-gray-light font-bold mb-4">Brands</h4>
                        <ul v-for="brand in brands" class="flex flex-col items-left">
                            <li class="mb-2">
                                <a :href="`/shoes?id=${brand.id}&category=${brand.name}`" class="text-custom-gray hover:opacity-75">
                                    {{brand.name}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-3 md:mt-0">
                        <h4 class="text-lg text-custom-gray font-bold mb-4">Type</h4>
                            <ul v-for="subcategory in subcategories" class="flex flex-col items-left">
                                <li class="mb-2">
                                    <a :href="`/shoes?id=${subcategory.id}&subcategory=${subcategory.name}`" class="text-custom-gray hover:opacity-75">
                                        {{subcategory.name}}
                                    </a>
                                </li>
                            </ul>
                    </div>
                </div>
            </span>
        </li>
        <li class="mb-4 md:mb-0 md:ml-4">
            <a href="" class="text-custom-gray hover:opacity-75">
                Company
            </a>
        </li>
        
        <cartQty ></cartQty>
        <div v-if="customer" class="relative md:mb-0 md:ml-4 flex flex-col">
            <div class="flex items-center justify-around w-full md:w-24 px-2 py-1 bg-custom-gray-lighter " :class="(userStatus) ? 'rounded-t-lg' : 'rounded-full'">
                <img class="h-8 w-8 p-1 text-white bg-white rounded-full" :src="customer.avatar ? `/storage/user/${customer.avatar}` : `/svg/avatar.svg`">
                <svg v-if="userStatus" @click="userStatus = false" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z"/></svg>
                <svg v-else @click="userStatus = true" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
            <div v-if="userStatus" class="absolute top-0 left-0 md:right-0 mt-10 bg-custom-gray-lighter px-2 py-1 rounded-b-lg w-full md:w-24 flex  flex-col border-gray-300 border-t-2">
                <a href="" class="mt-2 flex items-left mb-2 no-underline">
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
                brands     : null,
                subcategories : null,
                err        : null,
                csrf       : document.head.querySelector('meta[name="csrf-token"]').content
        	}
        },
        mounted() {
            this.getCategories();
        },
        methods: {
            async getCategories(){
                axios.get('/categories')
                .then(res => {
                    let data = res.data;
                    this.brands = data.brands;
                    this.subcategories = data.subcategories;
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
