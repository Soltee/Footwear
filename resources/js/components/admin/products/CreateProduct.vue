<template>
    <div class="px-4">
        <form @submit.prevent="saveProduct" :enctype="`multipart/form-data`">
            
            <div class="flex flex-row justify-between items-center mb-3">
                <h1 class="m-0 text-lg font-bold">New Product</h1>
                <button type="submit"  class=" hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline" >
                    Save
                </button>          
            </div>

            <div>
                <div class="flex w-full items-center justify-center bg-grey-lighter mb-3">
                    <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue ">
                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                        </svg>
                        <span class="mt-2 text-lg">Choose Product Images</span>
                        <input type='file' id="files" ref="files"  class="hidden" multiple @change="handleFileUpload" />
                    </label>
                </div>
                    <div class="flex flex-col  rounded-lg mb-3">
                        <label for="name" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Name</label>
                        <input type="text" id="name" v-model="name" class="px-3 py-3 rounded-lg  bg-gray-300 text-gray-900">
                    </div>
                    <div class="flex flex-row items-center justify-between mb-3">
                        <div class="flex-1 flex flex-col  rounded-lg mr-2">
                            <label for="price" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Price</label>
                            <input type="text" id="price" v-model="price" class="px-3 py-3 rounded-lg  bg-gray-300 text-gray-900  w-full">
                        </div>
                        <div class="flex-1 flex flex-col  rounded-lg ml-2">
                            <label for="qty" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Quantity</label>
                            <input type="text" id="qty" v-model="qty" class="px-3 py-3 rounded-lg  bg-gray-300 text-gray-900  w-full">
                        </div>
                    </div>

                    <div class="flex flex-row items-center justify-between mb-3">
                    
                        <label class="flex-1 block mb-3 mr-2">
                          <span class="text-gray-700 mb-2">Category</span>
                          <select class="form-select mt-1 block w-full" v-model="selectedCat" >
                            <option v-for="category in categoriesArray" :value="category.id">{{category.name}}</option>
                          </select>
                        </label>

                        <label class="block mb-3 flex-1 ml-2" v-if="selectedCat">
                          <span class="text-gray-700 mb-2">SubCategory</span>
                          <select class="form-select mt-1 block w-full" v-model="selectedSubCat" :disabled='!selectedCat' :class="(selectedCat) ? 'opacity-100' : 'opacity-75 cursor-not-allowed'">
                            <option v-for="subcategory in subCategoriesArray" :value="subcategory.id">{{subcategory.name}}</option>
                          </select>
                        </label>
                    </div>
                    
                    <div class="flex flex-col  rounded-lg mb-3">
                        <label for="description" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Description</label>
                        <textarea id="description" v-model="description" class="px-3 py-3 rounded-lg  bg-gray-300 text-gray-900 w-full h-24">
                        </textarea>
                    </div>
                    <div class="flex flex-col  rounded-lg mb-3">
                        <label for="description" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Excerpt</label>
                        <textarea id="description" v-model="excerpt" class="px-3 py-3 rounded-lg  bg-gray-300 text-gray-900 w-full h-16">
                        </textarea>
                    </div>           
            </div>

        </form>

    </div>
</template>

<script>
import { serverBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';

    export default {
        name : 'create-product',
        props: ['categories'],
        components: {

        },
        data(){
        	return {
        		categoriesArray : [],
                subCategoriesArray : [],
                name            : '',
                csrf            : document.head.querySelector('meta[name="csrf-token"]').content,
                flies           : '',
                saveDetail      : false,
                name            : '',
                price           : '',
                qty             : '',
                description     : '',
                excerpt         : '',
                selectedCat     : '',
                selectedSubCat  : '',
                productId       : 1,
        	}
        },

        mounted() {
        	this.pushToData();
        },
        watch: {
            selectedCat: function() {
                this.getSubCategories();
            }
        },
        methods: {
        	pushToData(){
        		this.categories.forEach((category) => {
        			this.categoriesArray.push(category); 		
        		});
        	},
            handleFilePondInit: function() {
                console.log('FilePond has initialized');

                // FilePond instance methods are available on `this.$refs.pond`
            },
            getSubCategories(){
                if(this.selectedCat !== null){
                    axios.get(`/admin/getSubCategories/${this.selectedCat}`)
                    .then(res =>{
                        if(res.status == 200){
                            res.data.subcategories.forEach((subcategory) => {
                                this.subCategoriesArray.push(subcategory);
                            });
                        }
                    }).catch(err => {
                        Toast.fire({
                          icon: 'error',
                          title: 'Network Error!'
                        });
                    })
                }
            },
            handleFileUpload(){
                this.files = this.$refs.files.files;
                console.log(this.flies);
            },
            saveProduct(){
                let formData = new FormData();
                for( var i = 0; i < this.files.length; i++ ){
                    let file = this.files[i];

                    formData.append('files[' + i + ']', file);
                }

                formData.append('name', this.name);
                formData.append('price', this.price);
                formData.append('qty', this.qty);
                formData.append('category', this.selectedCat);
                formData.append('subcategory', this.selectedSubCat);
                formData.append('description', this.description);
                formData.append('excerpt', this.excerpt);
                axios.post(`/admin/products`,
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(function(){
                    if(res.status == 201){
                        Toast.fire({
                            icon: 'success',
                            title:   `Product was created successfully!`
                        });
                    } else {
                        Toast.fire({
                          icon: 'error',
                          title: 'There was some network error!'
                        });
                    } 

                })
                .catch(function(){
                    Toast.fire({
                      icon: 'error',
                      title: 'There was some network error!'
                    });
                });
            }
        }
    }
</script>
