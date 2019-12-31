<template>
    <div class="">

        <p class="bg-green-500 text-white rounded-lg text-md">
            {{ message }}
        </p>
        <div class="flex flex-row justify-between items-center">
            <h3 class="text-admin-btn text-lg font-bold">Products</h3>
            <div class="relative flex items-center">
                

                <input
                    v-model="keyword"
                    @focus="searchStatus = true"
                    @keyup=" searchProducts();"
                    class="relative w-64  block appearance-none rounded-full  bg-white border border-gray-400 hover:border-gray-500 pl-16 py-2 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline" id="grid-first-name" type="text" name="name"

                    placeholder="Search Table">
                <svg class="absolute left-0 top-0 mt-1 ml-2 h-8 w-8" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M37.2309 30.1598C38.9903 27.1823 40 23.709 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40C23.709 40 27.1823 38.9904 30.1598 37.2309L37.7487 44.8198C39.7014 46.7724 42.8672 46.7724 44.8198 44.8198C46.7724 42.8672 46.7724 39.7014 44.8198 37.7487L37.2309 30.1598Z" fill="#201E16"/>
                    <circle opacity="0.3" cx="20" cy="20" r="15" fill="white"/>
                </svg>
                <svg @click="searchStatus = false;" xmlns="http://www.w3.org/2000/svg" class="absolute right-0 top-0 mt-1 mr-2 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>

        </div>
        

        <div> 
            <div class="overflow-x-scroll w-full mt-6">
                
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                          <th class="px-4 py-3 text-left text-gray-900">Id</th>
                          <th class="px-4 py-3 text-left text-gray-900">Image</th>
                          <th class="px-4 py-3 text-left text-gray-900">Name</th>
                          <th class="px-4 py-3 text-left text-gray-900">Price</th>
                          <th class="px-4 py-3 text-left text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-if="!searchStatus" v-for="p in productArray">
                          <td class="border px-4 py-2 text-gray-900">{{ p.id }}</td>
                          <td class="border px-4 py-2 text-gray-900">
                              <img class="h-24 w-24 rounded-full" :src="`/storage/${p.imageUrl}`">
                          </td>
                          <td class="border px-4 py-2 text-gray-900">{{ p.name }}</td>
                          <td class="border px-4 py-2 text-gray-900">Rs {{ p.price }}</td>
                          <td class="">
                            <div class="flex justify-around items-center">                                
                                <!-- <form @submit.prevent="updateCart(p)"> -->
                                    <!-- <div class="flex flex-row items-center"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 "><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <!-- </div> -->
                                <!-- </form> -->
                                <button type="submit" @click="filterProduct(p); dropProduct(p)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </button> 
                            </div>
                          </td>
                        </tr>
                         <tr v-if="searchStatus" v-for="p in searchArray">
                          <td class="border px-4 py-2 text-gray-900">{{ p.id }}</td>
                          <td class="border px-4 py-2 text-gray-900">
                              <img class="h-24 w-24 rounded-full" :src="`/storage/${p.imageUrl}`">
                          </td>
                          <td class="border px-4 py-2 text-gray-900">{{ p.name }}</td>
                          <td class="border px-4 py-2 text-gray-900">Rs {{ p.price }}</td>
                          <td class="">
                            <div class="flex items-center">                                
                                <form @submit.prevent="updateCart(p)">
                                    <div class="flex flex-row items-center">
                                        <input class="px-4 py-3 w-16 text-center rounded-lg" type="text" name="">
                                        <button type="submit" class="p-3 rounded-lg text-blue-900 text-md ">
                                            Edit
                                        </button>
                                    </div>
                                </form>
                                <button type="submit" @click="filterProduct(p); dropProduct(p)">Drop</button> 
                            </div>
                          </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        	<!-- <div v-for="product in productArray">
        		<div  class="flex flex-wrap group border-2  border-transparent hover:border-green-500 items-center justify-between " @click="redirectTo(product)">
                        <div class="flex flex-row">
                            <img class="h-24 w-24 rounded-full" :src="`/storage/${product.imageUrl}`">
                            <h4 class="m-0">{{ product.name }}</h4>
                            <a :href="`/admin/products-edit/${product.id}-${product.name}`">Edit Product</a>
                            <button type="submit"
                         @click="filterProduct(product); dropProduct(product)">Drop</button>   
                        </div>      
        		</div>
        	</div>
        	<div class="flex">

        		<a  :href="`${ifExists(links.prevPage)}`"  class="px-2 py-2 bg-blue-800" >Prev </a>
        		<span>{{ links.currentPage }}</span>
        		<a  :href="`${ifExists(links.nextPage)}`" class="px-2 py-2 bg-blue-800">Next </a>
        	</div> -->
        </div>

       <!--  <div>
            <div class="flex justify-between items-center">
                <span :class="(searchError) ? 'border-red-500 border-2' : ''">{{ (resultTotal) ? (resultTotal) : 0 }} results found for {{ keyword }}</span>   
            </div>
            <div v-for="product in searchArray">
                <div class="flex flex-wrap items-center justify-between group border-2  border-transparent hover:border-green-500" @click="redirectTo(product)">
                    <span>{{ product.id }}</span>
                    <img class="h-24 w-24 rounded-full" :src="`/storage/${product.imageUrl}`">
                    <h4>{{ product.name }}</h4>
                    <button type="submit" @click="filterProduct(product); dropProduct(product)">Drop</button>
                </div>
            </div>
        </div> -->

    </div>
</template>

<script>
    export default {
        name : 'products-view',
        props: ['products', 'shown', 'total'],
        data(){
        	return {
        		productArray : [],
                selected: false,
        		links : null,
                keyword: '',
                searchStatus : false,
                searchArray: [],
                searchError: false,
                resultTotal : 0,
                message: null,
                error: null
        	}
        },
        mounted() {
        	this.pushToData();
        },
        methods: {
        	pushToData(){
        		let All = this.products;
        		this.links = {
        			prevPage :  All.prev_page_url,
        			nextPage : All.next_page_url,
        			currentPage : All.current_page
        		};
        		All.data.forEach((product) => {
        			this.productArray.push(product); 		
        		});
        		console.log(All.data);
        	},
        	ifExists(page){
        		if(!page){return 'No page.'} else {return page;}
        	},
        	filterProduct(product){
        		
                if(this.searchStatus){
                    this.productArray = this.productArray.filter((state) => {
                        return state.id !== product.id;
                    });
                } else {
                    this.searchArray = this.searchArray.filter((state) => {
                        return state.id !== customer.id;
                    });
                }
        	},
            searchProducts(){
                this.searchStatus = false;
                if(!this.keyword){return;}
                axios.get(`/admin/searchProducts/${this.keyword}`)
                    .then((res) => {
                        // console.log(res.data.customers);
                        let pdts = res.data.products;
                        this.resultTotal = res.data.total;
                        if(pdts.length > 0){
                            this.searchArray = pdts;
                            this.searchError = false;
                        } else {
                            this.searchArray = [];
                            this.searchError = true;
                        }
                        
                    }).catch((error) => {
                        this.searchError = error.data;
                    })
            },
            dropProduct(product){
                console.log(product);
                axios.post(`/admin/products/${product.id}`, {})
                    .then(res=>{
                        if(res.searchStatus == 204){
                        this.message = 'Product dropped.';                            
                        }
                    }).catch((error) => {
                        this.error = error.data;
                    });
            },
            redirectTo(product){
                window.location = `http://localhost:8000/admin/products/${product.id}-${product.name}`;   
            }
        }
    }
</script>
