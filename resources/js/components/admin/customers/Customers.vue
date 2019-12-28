<template>
    <div class="container">
        <p class="bg-green-500 text-white rounded-lg text-md">
            {{ message }}
        </p>
    	<form @submit.prevent="searchCustomer">
    		<input @input="status = false" type="text" name="" v-model="keyword" class="px-2 py-2 bg-blue-500 text-white">
    		<button type="submit">Search</button>
    		<span v-if="!status" @click="status = ! status">XXX</span>
    	</form >
    	<div v-if="status">
    		<div v-for="customer in customerArray">
	    		<div class="flex flex-wrap items-center justify-between group border-2 border-tranparent hover:border-green-500" @click="redirectTo(customer)">
	    			<!-- <span>{{ customer.id }}</span> -->
	    			<img class="h-24 w-24 rounded-full" :src="`/storage/${customer.avatar}`">
		    		<h4>{{ customer.name }}</h4>
		            <button type="submit" @click="filterCustomer(customer); dropCostumer(customer)">Drop</button>
	    		</div>
	    	</div>
	    	<div class="flex">

	    		<a  :href="`${links.prevPage}`"  class="px-2 py-2 bg-blue-800" >Prev </a>
	    		<span>{{ links.currentPage }}</span>
	    		<a  :href="`${links.nextPage}`" class="px-2 py-2 bg-blue-800">Next </a>
	    	</div>
    	</div>
    	<div v-else>
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
    	</div>

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
