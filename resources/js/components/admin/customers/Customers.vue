<template>
    <div class="container">
        <p class="bg-green-500 text-white rounded-lg text-md">
            {{ message }}
        </p>

        <div class="flex flex-row justify-between items-center">
            <h3 class="text-admin-btn text-lg font-bold">Products</h3>
            <div class="relative flex items-center">
                

                <input
                    v-model="keyword"
                    @focus="searchStatus = true;"
                    @keyup=" searchProducts();"
                    class="relative w-40 md:w-64  block appearance-none rounded-full  bg-white border border-gray-400 hover:border-gray-500 pl-16 py-2 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline" id="" type="text" name="name"

                    placeholder="Search Table">
                <svg class="absolute left-0 top-0 mt-1 ml-2 h-8 w-8" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M37.2309 30.1598C38.9903 27.1823 40 23.709 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40C23.709 40 27.1823 38.9904 30.1598 37.2309L37.7487 44.8198C39.7014 46.7724 42.8672 46.7724 44.8198 44.8198C46.7724 42.8672 46.7724 39.7014 44.8198 37.7487L37.2309 30.1598Z" fill="#201E16"/>
                    <circle opacity="0.3" cx="20" cy="20" r="15" fill="white"/>
                </svg>
                <svg @click="searchStatus = false;" xmlns="http://www.w3.org/2000/svg" class="absolute right-0 top-0 mt-1 mr-2 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>

        </div>

        <div> 
            <div class="overflow-x-scroll w-full mt-6 md:overflow-hidden">
                
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                          <th class="px-4 py-3 text-left text-gray-900">Id</th>
                          <th class="px-4 py-3 text-left text-gray-900">Avatar</th>
                          <th class="px-4 py-3 text-left text-gray-900">Name</th>
                          <th class="px-4 py-3 text-left text-gray-900">Email</th>
                          <th class="px-4 py-3 text-left text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-if="!searchStatus" v-for="customer in customerArray">
                          <td class="border px-4 py-2 text-gray-900">{{ customer.id }}</td>
                          <td class="border px-4 py-2 text-gray-900">
                              <img class="h-16 w-16 md:h-24 md:w-24 rounded-full" :src="`/storage/${customer.avatar}`">
                          </td>
                          <td class="border px-4 py-2 text-gray-900">{{ customer.name }}</td>
                          <td class="border px-4 py-2 text-gray-900">Rs {{ customer.email }}</td>
                          <td class="">
                            <div class="flex justify-around items-center">                                
                                <!-- <form @submit.prevent="updateCart(p)"> -->
                                    <!-- <div class="flex flex-row items-center"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 "><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <!-- </div> -->
                                <!-- </form> -->
                                <button type="submit" @click="removeModal = true;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </button> 
                            </div>
                          </td>
                        </tr>
                         <tr v-if="searchStatus" v-for="customer in searchArray">
                          <td class="border px-4 py-2 text-gray-900">{{ customer.id }}</td>
                          <td class="border px-4 py-2 text-gray-900">
                              <img class="h-24 w-24 rounded-full" :src="`/storage/${customer.avatar}`">
                          </td>
                          <td class="border px-4 py-2 text-gray-900">{{ customer.name }}</td>
                          <td class="border px-4 py-2 text-gray-900">Rs {{ customer.email }}</td>
                          <td class="">
                            <div class="flex justify-around items-center">                                
                                    <!-- <div class="flex flex-row items-center"> -->
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 "><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <!-- </div> -->
                                <!-- </form> -->
                                <button type="submit" @click="removeModal = true;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </button> 
                            </div>
                          </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <!-- <div class="my-6">      
                <div class="flex justify-center items-center">

                    <a  :href="`${ifExists(links.prevPage)}`"  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" >Older </a>
                    <span class="text-gray-800 mx-4 font-semibold">{{ links.currentPage }}</span>
                    <a  :href="`${ifExists(links.nextPage)}`" class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover">Newer </a>
                </div>
            </div> -->
        </div>
<!-- 
    	<form @submit.prevent="searchCustomer">
    		<input @input="status = false" type="text" name="" v-model="keyword" class="px-2 py-2 bg-blue-500 text-white">
    		<button type="submit">Search</button>
    		<span v-if="!status" @click="status = ! status">XXX</span>
    	</form > -->
    	<!-- <div v-if="status">
    		<div v-for="customer in customerArray">
	    		<div class="flex flex-wrap items-center justify-between group border-2 border-tranparent hover:border-green-500" @click="redirectTo(customer)">
	    			<!-- <span>{{ customer.id }}</span> -->
	    			<!-- <img class="h-24 w-24 rounded-full" :src="`/storage/${customer.avatar}`">
		    		<h4>{{ customer.name }}</h4>
		            <button type="submit" @click="filterCustomer(customer); dropCostumer(customer)">Drop</button>
	    		</div>
	    	</div>
	    	<div class="flex">

	    		<a  :href="`${links.prevPage}`"  class="px-2 py-2 bg-blue-800" >Prev </a>
	    		<span>{{ links.currentPage }}</span>
	    		<a  :href="`${links.nextPage}`" class="px-2 py-2 bg-blue-800">Next </a>
	    	</div> -->
    	<!-- </div> --> -->
    	<!-- <div v-else>
            <div class="flex justify-between items-center">
                <span :class="(searchError) ? 'border-red-500 border-2' : ''">{{ (resultTotal) ? (resultTotal) : 0 }} results found for {{ keyword }}</span>   
            </div>
    		<div v-for="customer in searchArray">
    			<div class="flex flex-wrap items-center justify-between group border-2 border-tranparent hover:border-green-500" @click="redirectTo(customer)">
	    			<img class="h-24 w-24 rounded-full" :src="`/storage/${customer.avatar}`">
		    		<h4>{{ customer.name }}</h4>
		            <button type="submit" @click="filterCustomer(customer); dropCostumer(customer)">Drop</button>
	    		</div>
	    	</div>
    	</div> -->

    </div>
</template>

<script>
    export default {
        name : 'customers-view',
        props: ['customers'],
        data(){
        	return {
        		customerArray : [],
        		links : null,
        		keyword: '',
        		status : true,
        		searchArray: [],
        		searchError: '',
                searchStatus:false,
        		resultTotal : false,
                message: null,
                error: null
        	}
        },
        mounted() {
        	this.pushToData();
        },
        methods: {
        	pushToData(){
        		let All = this.customers;
        		this.links = {
        			prevPage :  All.prev_page_url,
        			nextPage : All.next_page_url,
        			currentPage : All.current_page
        		};
        		All.data.forEach((customer) => {
        			this.customerArray.push(customer);		
        		});
        	},
        	ifExists(page){
        		if(!page){return 'No page.'} else {return page;}
        	},
        	filterCustomer(customer){

        		if(this.status){
        			this.customerArray = this.customerArray.filter((state) => {
	        			return state.id !== customer.id;
	        		});
        		} else {
        			this.searchArray = this.searchArray.filter((state) => {
	        			return state.id !== customer.id;
	        		});
        		}
        		
        	},
        	searchCustomer(){
        		this.status = false;
                if(!this.keyword){return;}
        		axios.get(`/admin/searchCustomers/${this.keyword}`)
        			.then((res) => {
        				// console.log(res.data.customers);
        				let ctms = res.data.customers;
                        this.resultTotal = res.data.total;
        				if(ctms.length > 0){
        					this.searchArray = ctms;
                            this.searchError = false;
		        		} else {
                            this.searchArray = [];
        					this.searchError = true;
	        			}
        				
        			}).catch((error) => {
        				this.searchError = error.data;
        			})
        	},
            dropCostumer(customer){
                axios.post(`/admin/customers/${customer.id}`, {})
                    .then(res=>{
                        if(res.status == 204){
                        this.message = 'Product dropped.';                            
                        }
                    }).catch((error) => {
                        this.error = error.data;
                    });
            },
            redirectTo(customer){
                window.location = `http://localhost:8000/admin/customers/${customer.id}-${customer.name}`;   
            }
        }
    }
</script>
