<template>

    <div class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
        <div class="h-full w-full bg-gray-300" @click="closeModal">
            
        </div>
        <div class="absolute  bg-gray-400 left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
            <div class="text-right">
                <button @click="closeModal" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>

            </div>
            <div>
                <div v-if="type == 'category'" class="">
                    <h3 class="text-admin-btn text-lg font-bold my-2">New Category</h3>
                    <form @submit.prevent="add">
                        <div class=" flex  flex-col "> 
                            <label for="name" class=" px-2 py-3 text-gray-800 text-md font-semibold mb-3">Name</label>
                            <div class="relative flex flex-row items-center">  
                                <input
                                v-model="inputname"
                                class="relative w-40 md:w-64  block appearance-none rounded-l-lg  bg-white border border-gray-400 hover:border-gray-500 pl-2 py-2 pr-16  leading-tight " id="" type="text"

                                placeholder="Category Name">
                                <button type="submit"  class="absolute right-0 inset-y-0 hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-2 px-4 rounded-r-lg focus:outline-none focus:shadow-outline" >
                                    Save 
                                </button> 
                            </div>
                        </div>

                    </form>
                </div>
                <div v-if="type == 'subcategory'" class="">
                    <h3 class="text-admin-btn text-lg font-bold my-2">New Subcategory</h3>

                    <form @submit.prevent="add">
                        <div class="relative flex flex-col justify-between "> 
                            <div class="flex flex-col  rounded-lg mb-3">
                                <label for="name" class=" px-2 py-3 text-gray-800 text-md font-semibold ">Name</label>
                                <input
                                v-model="inputname"
                                class="relative w-full  block appearance-none rounded-lg  bg-white border border-gray-400 hover:border-gray-500 pl-2 py-2 pr-16  leading-tight " id="" type="text"

                                placeholder="subcategory name">
                            </div>

                            <div class="flex flex-col  rounded-lg mb-3">

                                <label class="block mb-3 flex-1 ml-2" >
                                  <span class="text-gray-700 mb-2">Categories</span>
                                 
                                  <select  class="form-select mt-1 block w-full" v-model="category">
                                    <option value="" disabled>Select Category</option>
                                    <option  v-for="cat in categories" :value="cat.id">{{cat.name}}</option>
                                  </select>
                                </label>
                            </div>
                            <button type="submit"  class="hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" >
                                Save 
                            </button> 
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
  
</template>

<script>
import { eventBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';

    export default {
        name : 'CreateModal',
        props: {
            type : {
                type : String,
                required :true
            }
        },
        data(){
            return {
                category : '',
                inputname : '',
                categories : []
            }
        },
        mounted(){
            if(this.type == 'subcategory'){
                this.getCategories();
            }
        },
        methods: {
        	closeModal(){
                eventBus.$emit('close-modal');
            },
            emit(){
                eventBus.$emit('create-type');
            },
            add(){
                let endpoint = `/admin`;
                let formData = new FormData();

                formData.append('name', this.inputname);

                if(this.type == 'category'){
                    endpoint += `/categories`;
                } else if(this.type == 'subcategory'){
                    endpoint += '/subcategories';
                    formData.append('category', this.category);
                }
                console.log(formData);

                axios.post(`${endpoint}`, 
                    formData
                ).then(res => {
                        if(res.status == 201){
                            eventBus.$emit('success', res.status);
                        }
                    }).catch(err => {
                        Toast.fire({
                          icon: 'error',
                          title: 'Network Error!'
                        });
                    });
            },
            getCategories(){
                axios.get(`/admin/getCategories?pagiate=all`)
                .then(res => {
                        let data = res.data;
                        if(res.status == 200){
                            this.categories = [];
                            data.categories.forEach((category) => {
                                this.categories.push(category);
                            });
                        }
                    }).catch(err => {
                        Toast.fire({
                          icon: 'error',
                          title: 'Network Error!'
                        });
                    });
            }
        }
    }
</script>
