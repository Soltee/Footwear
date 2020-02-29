<template>
    <div class="">
        <svg v-if="menuStatus" @click="menuStatus = false; $emit('searchClose', {close:false});" class="block md:hidden w-8 h-8 text-custom-gray cursor-pointer hover:text-custom-gray-lighter" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
        <svg v-else @click="menuStatus = true" class="block md:hidden w-8 h-8 text-custom-gray cursor-pointer hover:text-custom-gray-lighter" viewBox="0 0 34 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.798828" width="33.2015" height="4" rx="2" fill="currentColor"/>
            <rect x="0.798828" y="12" width="33.2015" height="4" rx="2" fill="currentColor"/>
            <rect x="0.798828" y="24" width="33.2015" height="4" rx="2" fill="currentColor"/>
        </svg>
        <div class="flex flex-col md:flex-row justify-around items-center">
            <li class="mr-6">
                <a :href="`/#`" @click.prevent="searchModal = true;">
                    <svg class=" w-6 h-6 cursor-pointer text-white hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                    </svg>
                </a>
            </li>

            <li class="mr-6 ">
                <a href="/shoes">
                    <h4 class="text-lg text-custom-gray font-bold">Shoes</h4>
                </a>
                  
            </li>
            
            <cartQty ></cartQty>

            <li v-if="customer" class="flex items-center flex-row ">
                <a :href="`/dashboard`" class="mr-6">
                    <img class="h-8 w-8 p-1 text-white bg-white rounded-full" :src="customer.avatar ? `/storage/${customer.avatar}` : `/svg/avatar.svg`">
                </a>
                    
               
                <form :method="`POST`" :action="`/customer-logout`">
                    <input type="hidden" name="_token" :value="`${csrf}`">
                    <button type="submit" class="cursor-pointer bg-admin-red hover:bg-custom-red-lighter text-white px-4 py-3 rounded-lg">Logout</button>                            
                </form>
            </li>
            <li v-else>
                <a :href="`/login`" class="flex items-center content-between bg-custom-red-darker hover:bg-custom-red-lighter  px-8 py-1 rounded-full">
                    <svg class="w-8 h-8 text-custom-gray" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M416 448h-84c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h84c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32h-84c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h84c53 0 96 43 96 96v192c0 53-43 96-96 96zm-47-201L201 79c-15-15-41-4.5-41 17v96H24c-13.3 0-24 10.7-24 24v96c0 13.3 10.7 24 24 24h136v96c0 21.5 26 32 41 17l168-168c9.3-9.4 9.3-24.6 0-34z"/></svg>
                    <span class="text-custom-gray ml-3 font-bold text-lg">Login</span>
                </a>
            </li>
        </div>
           
        <div v-if="searchModal" class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
            <div class="h-full w-full bg-gray-300" @click="searchModal = false;">
                
            </div>
            <div class="absolute  bg-white left-0 right-0  mx-auto  h-full shadow-lg rounded-lg p-6 z-30">
                <div class="text-right">
                    <button @click="searchModal = false;" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                        <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </button>
                </div>
                <div class="">
                    <form  @submit.prevent="searchShoes">
            
                    <div class=" relative flex flex-row items-center">
                        <button class="absolute left-0 top-0 mt-6 ml-3 cursor-pointer" type="submit">
                            <svg class="h-10 w-10 text-blue-900" fill="currentColor" viewBox="0 0 61 55" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M37.2309 34.1598C38.9903 31.1823 40 27.709 40 24C40 12.9543 31.0457 4 20 4C8.9543 4 0 12.9543 0 24C0 35.0457 8.9543 44 20 44C23.709 44 27.1823 42.9904 30.1598 41.2309L37.7487 48.8198C39.7014 50.7724 42.8672 50.7724 44.8198 48.8198C46.7724 46.8672 46.7724 43.7014 44.8198 41.7487L37.2309 34.1598Z" fill="#201E16"/>
                                </g>
                                <circle opacity="0.3" cx="20" cy="24" r="15" fill="white"/>
                                <defs>
                                <filter id="filter0_d" x="0" y="0" width="60.2843" height="54.2843" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                                <feOffset dx="10"/>
                                <feGaussianBlur stdDeviation="2"/>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                                </filter>
                                </defs>
                                </svg>     
                        </button>
                        <input v-focus  :class="(focus) ? 'border-blue-900':''" type="text" name="" v-model="keyword" class="w-full px-16 py-6 mt-3 bg-transparent  text-blue-900 text-md border-b-2 border-transparent" @focus="focus = true" >
                        <svg @click="keyword = ''; shoesArray=[];" class="absolute right-0 top-0 mt-6 h-6 w-6 text-blue-900 mr-3 cursor-pointer"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                    </div>
                </form >
                
                <h4 class="text-gray-800 font-semibold text-lg md:text-xl my-3">Search Results : {{ shoesArray.length }}</h4>

                <div class="h-90 my-3 overflow-y-scroll">
                    <div v-for="s in shoesArray" class="my-4 grid grid-flow-row  items-center">
                        <div class="flex flex-col md:flex-row items-center justify-around group border-2 border-transparent hover:border-gray-400 rounded-lg px-3 py-2 cursor-pointer mb-3" >
                            <a :href="`/shoes/${s.id}/${s.name}`" class="mb-3 md:mb-0 md:mr-3">{{ s.name }}</a>
                            <a :href="`/shoes/${s.id}/${s.name}`">
                                <img class="w-full md:w-48 rounded-lg" :src="`/storage/${s.imageUrl}`">
                            </a>
                        </div> 
                    </div>
                </div>
                    
                </div>
                
            </div>

        </div>

    </div>
</template>

<script>
import cartQty from './CartQty';
import Toast from '../helpers/Alert.js';

    export default {
        name : 'Navmenu',
        props : ['customer'],
        directives: {
          focus: {
            // directive definition
            inserted: function (el) {
              el.focus();
            }
          }
        },
        components: {
            cartQty, Toast
        },
        data(){
        	return {
                menuStatus : false,
                searchModal : false,
                focus : false,
                keyword     : '',
                searching   : false,
                shoesArray  : [],
                csrf        : document.head.querySelector('meta[name="csrf-token"]').content,
        	}
        },
        methods : {
            searchShoes(){
                this.searching = true;
                axios.get(`/searchShoes/${this.keyword}`)
                .then(res => {
                    if(res.status == 200){
                        this.shoesArray = res.data.shoes;
                        this.searching = false;
                    }
                }).catch(err => {
                    Toast.fire({
                          icon: 'error',
                          title:   `Server error. Please try again.`
                    }); 
                });
            }
        }
    };
</script>
<style scoped>
</style>
