<template>
    <div class="container">
        <form @submit.prevent="searchCustomer">
            <input @input="status = false" type="text" name="" v-model="keyword" class="px-2 py-2 bg-blue-500 text-white">
            <button type="submit">Search</button>
            <span v-if="!status" @click="status = ! status">XXX</span>
        </form >

        <div v-if="status"> 
                   
        	<div v-for="product in productArray">
        		<div class="flex flex-wrap items-center justify-between">
        			<span>{{ product.id }}</span>
        			<img class="h-24 w-24 rounded-full" :src="`/storage/${product.imageUrl}`">
    	    		<h4>{{ product.name }}</h4>
    	            <button type="submit" @click="filterProduct(product)">Drop</button>
        		</div>
        	</div>
        	<div class="flex">

        		<a  :href="`${ifExists(links.prevPage)}`"  class="px-2 py-2 bg-blue-800" >Prev </a>
        		<span>{{ links.currentPage }}</span>
        		<a  :href="`${ifExists(links.nextPage)}`" class="px-2 py-2 bg-blue-800">Next </a>
        	</div>
        </div>

        <div v-else>
            <div class="flex justify-between items-center">
                <span :class="(searchError) ? 'border-red-500 border-2' : ''">{{ (resultTotal) ? (resultTotal) : 0 }} results found for {{ keyword }}</span>   
            </div>
            <div v-for="product in searchArray">
                <div v-if="product.error">
                    <p class="border-red-500 rounded-lg p-2 text-red-500">
                        {{ product.error }}
                    </p>
                </div>
                <div v-else>
                    <div class="flex flex-wrap items-center justify-between">
                        <span>{{ product.id }}</span>
                        <img class="h-24 w-24 rounded-full" :src="`/storage/${product.imageUrl}`">
                        <h4>{{ product.name }}</h4>
                        <button type="submit" @click="filterProduct(product)">Drop</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name : 'products-view',
        props: ['products'],
        data(){
        	return {
        		productArray : [],
        		links : null,
                keyword: '',
                status : true,
                searchArray: [],
                searchError: false,
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
        		
                if(this.status){
                    this.productArray = this.productArray.filter((state) => {
                        return state.id !== product.id;
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
                axios.get(`searchProducts/${this.keyword}`)
                    .then((res) => {
                        // console.log(res.data.customers);
                        let pdts = res.data.products;
                        this.resultTotal = pdts.length;
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
            }
        }
    }
</script>
