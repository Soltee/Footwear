<template>
	<div>
		<div v-show="message">
			<p class="bg-green-500 text-white rounded-lg text-md">
	            {{ message }}
	        </p>
		</div>
		<div v-show="error">
			<p class="bg-red-500 text-white rounded-lg text-md">
	            {{ erro }}
	        </p>
		</div>
		<div class="flex flex-row">
			<img class="h-24 w-24 rounded-full" :src="`/storage/${customer.avatar}`">
			<div class="flex flex-col">
				<h4>{{ customer.name }}</h4>
				<span>{{ customer.email }}  </span>
	        	<button class="bg-red-800 rounded-lg text-white hover:bg-red-700	" type="submit" @click="dropCostumer(customer)">Drop</button>
			</div>
		</div>
	</div>
</template>
<script>
    export default {
        name : 'show-customer',
        props: ['customer'],
        data(){return{message:null,error:null}},
        methods: {
        	dropCostumer(customer){
                axios.post(`/customers/${customer.id}`, {})
                    .then(res=>{
                        if(res.status == 204){
                        	this.message = 'Product dropped.';    
                        	setTimeout(() => {
                        		window.location = `http://localhost:8000/customers`;
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