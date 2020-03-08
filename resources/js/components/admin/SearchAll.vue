<template>
    <div class="container z-10">
      
        <svg v-if="!search" @click="focusInput" class="h-8 w-8 md:h-10 md:w-10 text-white cursor-pointer" fill="currentColor" viewBox="0 0 61 55" xmlns="http://www.w3.org/2000/svg">
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

    	<div  v-if="search" class="z-0 fixed inset-0 bg-gray-300">
            <div class="z-10 mx-3 md:mx-12 py-6 h-full ">
                <form  @submit.prevent="searchAll">
            
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
                        <svg @click="reset()" class="absolute right-0 top-0 mt-6 h-6 w-6 text-blue-900 mr-3 cursor-pointer"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                    </div>
                </form >
                <div v-if="status" class="p-3 my-2 text-blue-900 text-lg">
                    Loading ...
                </div>
                <div v-else class="mt-2 p-3 w-full rounded-lg  ">
                    <div class="flex justify-between items-center ">
                        <p :class="(resultError) ? 'border-red-500 border-2' : ''">
                            <span class="text-lg text-blue-900 font-medium">{{ (resultTotal) ? resultTotal : '0' }}
                            </span> 
                            results found for 
                            <span class="text-lg text-blue-900 font-medium">{{ keyword }}</span>
                        </p>
                          
                    </div>
                    <div class="w-full flex flex-col md:flex-row justify-between ">
                        <div v-if="products.length" class="flex flex-col md:w-1/2 pr-2 min-h-0 max-h-24 overflow-y-scroll overflow-x-auto">
                            <h4 class="m-0 mt-3 text-lg my-3">Products ({{ products.length }})</h4>
                            <div v-for="p in products" class="mt-3">
                                <div class="flex flex-row items-center justify-around group border-2 border-transparent hover:border-green-500 rounded-lg px-3 py-2  cursor-pointer mb-3" @click="redirectTo(p, 'products')">
                                    <img class="h-12 w-12 md:h-16 md:w-16 rounded-full" :src="`/storage/${p.imageUrl}`">
                                    <h4 class="m-0">{{ p.name }}</h4>
                                </div>
                            </div> 
                        </div>
                        <div v-if="customers.length" class="flex flex-col md:w-1/2 pl-2 min-h-0 max-h-24 overflow-y-scroll overflow-x-auto">
                            <h4 class="m-0 mt-3 text-lg my-3">Customers ({{ customers.length }})</h4>
                            <div v-for="c in customers" class="mt-3">
                                <div class="flex flex-row items-center justify-around group border-2 border-transparent hover:border-green-500 rounded-lg px-3 py-2 cursor-pointer mb-3" @click="redirectTo(c, 'customers')">
                                    <img class="h-12 w-12 md:h-16 md:w-16 rounded-full object-cover object-center" :src="`/storage/${c.avatar}`">
                                    <h4>{{ c.first_name }} {{ c.last_name }}</h4>
                                </div>     
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</template>

<script>
    export default {
        name : 'search-all-view',
        directives: {
          focus: {
            // directive definition
            inserted: function (el) {
              el.focus();
            }
          }
        },
        data(){
        	return {
                search : false,
                focus : false,
        		keyword: '',
        		status : false,
        		products: [],
                customers: [],
                resultTotal: null,
        		resultError: false
        	}
        },
        mounted() {
        },
        methods: {
            focusInput() {
                this.search = true; 
                // this.$refs.email.$el.focus();
            },
        	searchAll(){
        		this.status = true;
                if(!this.keyword){return;}
        		axios.get(`/admin/searchall/${this.keyword}`)
        			.then((res) => {
        				let data = res.data;
                        this.resultTotal = data.total;
                        if(data.total > 0){
                            if(data.products.length > 0){
                                this.products = data.products;
                            } else {
                                this.products = [];
                            }

                            if(data.customers.length > 0){
                                this.customers = data.customers;
                            } else {
                                this.customers = [];
                            }


                        } else {
                            this.resultError = true;
                        }
        				
        				
                        this.status = false;
        			}).catch((error) => {
        				this.resultError = error.data;
        			})
        	},
            reset(){
                this.resultTotal = null;
                this.keyword = '';
                this.status = false; 
                this.products = [];
                this.customers = [];
                this.search = false;
            },
            redirectTo(c, name){
                window.location = `http://localhost:8000/admin/${name}/${c.id}-${c.slug}`;   
            }
        }
    };
</script>
<style scoped>
    
</style>
