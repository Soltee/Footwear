<template>
    <div class="flex-1 flex flex-row justify-between">
        <div class="flex-1 overflow-hidden px-4">
                
            <form :method="`POST`" :action="`/management/products`" :enctype="`multipart/form-data`">
                <input type="hidden" name="_token" :value="csrf">

                <div class="flex flex-row justify-between items-center mb-3">
                    <h1 class="m-0 text-lg">Add Product</h1>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Insert
                    </button>
                </div>
                <div class="max-w-lg">
                    <div class="flex flex-row items-center  rounded-lg mb-3">
                        <label for="imageUrl" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md  ">Choose</label>
                        <input type="file" id="imageUrl" name="imageUrl" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
                    </div>
                    <div class="flex flex-row items-center  rounded-lg mb-3">
                        <label for="name" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md  ">Name</label>
                        <input type="text" id="name" name="name" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
                    </div>
                    <div class="flex flex-row items-center  rounded-lg mb-3">
                        <label for="price" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md ">Price</label>
                        <input type="text" id="price" name="price" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
                    </div>
                    <div class="flex flex-row items-center  rounded-lg mb-3">
                        <label for="qty" class="bg-blue-800 px-2 py-3 rounded-l-lg text-white text-md   ">Quantity</label>
                        <input type="text" id="qty" name="qty" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
                    </div>
                    
                    <div class="overflow-x-auto overflow-y-scroll w-auto h-32">
                        <div v-for="category in categoriesArray" class="px-2 py-3 rounded-lg">
                            <input type="checkbox" name="category" :value="category.id ">
                            <label for="category" >{{category.name}}</label>
                        </div>
                    </div>
                    
                    <div>
                        <textarea id="description" name="description">
                            
                        </textarea>
                    </div>

                    <div>
                        <input type="text" id="excerpt" name="excerpt" class="px-2 py-2 rounded-r-lg bg-blue-700 text-white">
                    </div>
                    <div>
                        <input type="checkbox" name="visible" id="visible">
                    </div>
                </div>
            </form>
        </div>

        <div class="w-64">
            <form @submit.prevent="addCategory">
                <input type="text" name="name" placeholder="Name Here" v-model="name">
                <button type="submit">Save</button>
            </form>
            <form :action="`/management/products`" method="POST">
                <input type="hidden" name="_token" :value="csrf">
                <div v-for="category in categoriesArray">
                    <label for="category">{{category.name}}</label>
                </div>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name : 'add-product',
        props: ['categories'],
        data(){
        	return {
        		categoriesArray : [],
                name: '',
                csrf : document.head.querySelector('meta[name="csrf-token"]').content,
        	}
        },
        mounted() {
        	this.pushToData();
        },
        methods: {
        	pushToData(){
        		this.categories.forEach((category) => {
                    // console.log(category);
        			this.categoriesArray.push(category); 		
        		});
        	},
      
        	filterCategory(category){
        		
                this.categoriesArray = this.categoriesArray.filter((state) => {
                    return state.id !== category.id;
                });
                
        	},
            addCategory(){
                axios.post(`/management/category/store`, {
                    name : this.name
                })
                    .then((res) => {
                        console.log(res.data);
                        // console.log(res.data.customers);
                        let cat = res.data.category;
                        this.categoriesArray.push(cat);
                        // this.resultTotal = res.data.total;
                        // if(pdts.length > 0){
                        //     this.searchArray = pdts;
                        //     this.searchError = false;
                        // } else {
                        //     this.searchArray = [];
                        //     this.searchError = true;
                        // }
                        
                    }).catch((error) => {
                        // this.searchError = error.data;
                    });
            }
        }
    }
</script>
