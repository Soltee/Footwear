<template>
	<div>
		<div v-show="message">
			<p class="bg-green-500 text-white rounded-lg text-md">
	            {{ message }}
	        </p>
		</div>
		<div v-show="error">
			<p class="bg-red-500 text-white rounded-lg text-md">
	            {{ error }}
	        </p>
		</div>
		<div class="flex flex-row">
			<img class="h-24 w-24 rounded-full" :src="`/storage/${products.avatar}`">
			<div class="flex flex-col">
				<h4>{{ products.name }}</h4>
	        	<button class="bg-red-800 rounded-lg text-white hover:bg-red-700	" type="submit" @click="dropCostumer(products)">Drop</button>
			</div>
		</div>
	</div>
</template>
<script>
    export default {
        name : 'show-product',
        props: ['products'],
        data(){return{message:null,error:null}},
        methods: {
        	dropCostumer(product){
                axios.post(`/admin/products/${product.id}`, {})
                    .then(res=>{
                        if(res.status == 204){
                        	this.message = 'Product dropped.';    
                        	setTimeout(() => {
                        		window.location = `http://localhost:8000/admin/products`;
                        	}, 3000);
                        }
                    }).catch((error) => {
                        this.error = error.data;
                    });
            },
        }
    }
</script>
<style>
	
</style>