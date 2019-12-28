<template>
    <div class="container">

        <p class="bg-green-500 text-white rounded-lg text-md">
            {{ message }}
        </p>
        <div class="flex flex-row justify-between items-center w-full">
            <h3 class="text-gray-900 text-xl font-bold">Products</h3>
            <!-- <form @submit.prevent="searchProducts">
                <input @input="searchStatus = false" type="text" name="" v-model="keyword" class="px-2 py-2 bg-gray-300 rounded-lg text-gray-900">
                <button type="submit">Search</button>
                <span v-if="!searchStatus" @click="searchStatus = ! searchStatus">XXX</span>
            </form > -->
            <input
                    v-model="keyword"
                    @blur="searchStatus = false"
                    @focus="searchStatus = true"
                    @keydown.esc="searchStatus = false"
                    @keyup=" searchProducts();"
                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="grid-first-name" type="text" name="name"

                    placeholder="Search Table">
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
        props: ['products'],
        data(){
        	return {
        		productArray : [],
                selected: false,
        		links : null,
                keyword: '',
                searchsearchStatus : true,
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
