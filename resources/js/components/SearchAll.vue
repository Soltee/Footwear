<template>
    <div class="container relative">
    	<form @submit.prevent="searchAll">
    		<input @input="status = false" type="text" name="" v-model="keyword" class="px-2 py-2 bg-blue-500 text-white">
    		<button type="submit">Search</button>
    		<span v-if="!status" @click="status = ! status">XXX</span>
    	</form >
    	<div v-if="status">
    	</div>
    	<div v-else class="abt w-64 rounded-b-lg h-64 overflow-x-hidden overflow-y-auto">
            <div class="flex justify-between items-center">
                <span :class="(resultError) ? 'border-red-500 border-2' : ''">{{ resultTotal }} results found for {{ keyword }}</span>
                  
            </div>
            
    		<div v-for="result in resultArray">
    			<div class="flex flex-wrap items-center justify-between">
	    			<span>{{ result.id }}</span>
	    			<img class="h-8 w-8 rounded-full" :src="`/storage/${result.avatar}`">
		    		<h4>{{ result.name }}</h4>
		            <button  @click="filterResult(result)">Drop</button>
	    		</div>
	    	</div>
            
    	</div>

    </div>
</template>

<script>
    export default {
        name : 'search-all-view',
        data(){
        	return {
        		keyword: '',
        		status : true,
        		resultArray: [],
                resultTotal: null,
        		resultError: false
        	}
        },
        mounted() {
        },
        methods: {
        	filterResult(result){

        		if(!this.status){
        			this.resultArray = this.resultArray.filter((state) => {
	        			return state.id !== result.id;
	        		});
        		}
        		
        	},
        	searchAll(){
        		this.status = false;
                if(!this.keyword){return;}
        		axios.get(`searchall/${this.keyword}`)
        			.then((res) => {
        				// console.log(res.data.customers);
        				let rtls = res.data.results;
                        this.resultTotal = rtls.length;
        				if(rtls.length > 0){
        					this.resultArray = rtls;
                            this.resultError = false;
		        		} else {
                            this.resultArray = [];
        					this.resultError = true;
	        			}
        				
        			}).catch((error) => {
        				this.resultError = error.data;
        			})
        	}
        }
    }
</script>
<style scoped>
    .abt{
        position: absolute;
        left: 0;
        top: 0;
        margin-top: 40px;
    } 
</style>
