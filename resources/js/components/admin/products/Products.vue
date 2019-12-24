<template>
    <div class="container">
        <p class="bg-green-500 text-white rounded-lg text-md">
            {{ message }}
        </p>
        <form @submit.prevent="searchProducts">
            <input @input="status = false" type="text" name="" v-model="keyword" class="px-2 py-2 bg-blue-500 text-white">
            <button type="submit">Search</button>
            <span v-if="!status" @click="status = ! status">XXX</span>
        </form >

        <div v-if="status"> 
                   
        	<div v-for="product in productArray">
        		<div  class="flex flex-wrap group border-2  border-transparent hover:border-green-500 items-center justify-between " @click="redirectTo(product)">
                        <div class="flex flex-row">
                            <img class="h-24 w-24 rounded-full" :src="`/storage/${product.imageUrl}`">
                            <h4 class="m-0">{{ product.name }}</h4>
                            <a :href="`/management/products-edit/${product.id}-${product.name}`">Edit Product</a>
                            <button type="submit"
                         @click="filterProduct(product); dropProduct(product)">Drop</button>   
                        </div>      
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
                <div class="flex flex-wrap items-center justify-between group border-2  border-transparent hover:border-green-500" @click="redirectTo(product)">
                    <span>{{ product.id }}</span>
                    <img class="h-24 w-24 rounded-full" :src="`/storage/${product.imageUrl}`">
                    <h4>{{ product.name }}</h4>
                    <button type="submit" @click="filterProduct(product); dropProduct(product)">Drop</button>
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
                selected: false,
        		links : null,
                keyword: '',
                status : true,
                searchArray: [],
                searchError: false,
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
            searchProducts(){
                this.status = false;
                if(!this.keyword){return;}
                axios.get(`/management/searchProducts/${this.keyword}`)
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
                axios.post(`/management/products/${product.id}`, {})
                    .then(res=>{
                        if(res.status == 204){
                        this.message = 'Product dropped.';                            
                        }
                    }).catch((error) => {
                        this.error = error.data;
                    });
            },
            redirectTo(product){
                window.location = `http://localhost:8000/management/products/${product.id}-${product.name}`;   
            }
        }
    }
</script>
