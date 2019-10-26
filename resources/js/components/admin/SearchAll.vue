<template>
    <div class="container ">
        <svg v-if="!search" @click="focusInput" class="h-6 w-6 text-white cursor-pointer" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
    	<div  v-if="search" class="z-0 fixed inset-0 bg-gray-300">
            <div class="z-10 mx-12 py-6 h-full  overflow-x-hidden overflow-y-scroll">
                <form  @submit.prevent="searchAll">
            
                    <div class=" relative flex flex-row items-center">
                        <button class="absolute left-0 top-0 mt-6 ml-3 cursor-pointer" type="submit">
                            <svg  class="h-6 w-6 text-blue-900" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>      
                        </button>
                        <input v-focus  :class="(focus) ? 'border-blue-900':''" type="text" name="" v-model="keyword" class="w-full px-12 py-6 bg-transparent  text-blue-900 text-md border-b-2 border-transparent" @focus="focus = true" >
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
                    <div class="flex flex-row justify-between ">
                        <div v-if="products.length" class="flex flex-col md:w-1/2 pr-2">
                            <h4 class="m-0 mt-3 text-lg ">Products {{ products.length }})</h4>
                            <div v-for="p in products">
                                <div class="flex flex-row items-center justify-between group border-2 border-transparent hover:border-green-500 cursor-pointer" @click="redirectTo(p, 'products')">
                                    <img class="h-8 w-8 rounded-full" :src="`/storage/${p.imageUrl}`">
                                    <h4 class="m-0">{{ p.name }}</h4>
                                    <span>{{ p.created_at }}</span>
                                </div>
                            </div> 
                        </div>
                        <div v-if="customers.length" class="flex flex-col md:w-1/2 pl-2">
                            <h4 class="m-0 mt-3 text-lg ">Customers ({{ customers.length }})</h4>
                            <div v-for="c in customers">
                                <div class="flex flex-row items-center justify-between group border-2 border-transparent hover:border-green-500 cursor-pointer" @click="redirectTo(c, 'customers')">
                                    <img class="h-8 w-8 rounded-full" :src="`/storage/${c.avatar}`">
                                    <h4>{{ c.name }}</h4>
                                    <span>{{ c.email }}</span>
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
        		axios.get(`/searchall/${this.keyword}`)
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
                window.location = `http://localhost:8000/${name}/${c.id}-${c.name}`;   
            }
        }
    }
</script>
<style scoped>
    
</style>
