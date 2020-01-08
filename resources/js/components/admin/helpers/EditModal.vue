<template>

    <div class="fixed inset-0  mx-auto max-w-4xl rounded-lg flex flex-col  justify-center rounded-lg z-20">
       <div class="bg-white  shadow-lg rounded-lg p-3 ">
            <div class="mb-3 text-right">
                <button @click="closeModal" type="button" class="px-4 py-2 cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>

            </div>
            <form @submit.prevent="updateProduct" enctype="multipart/form-data">
                    
                <div class="flex flex-row justify-between items-center mb-3">
                    <h1 class="m-0 text-lg font-bold text-gray-900">Edit Product</h1>
                    <button type="submit" class="bg-blue-500 hover:bg-gray-300 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Save
                    </button>
                </div>
                <div class="flex flex-row">
                        
                    <div class="overflow-y-scroll h-86">
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
                            <div class="flex-1 mr-2 flex flex-col ">
                                <label for="category" class=" px-2 py-3 text-gray-800 text-md font-semibold mb-2">Category</label>
                                <div class="inline-block relative">
                                        
                                    <select  class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option @change="category = category;" v-for="category in categoriesArray" v-model="category.id">
                                            {{category.name}}
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>  
                            <div v-if="subcategories.length > 1" class="flex-1 ml-2 flex flex-col">
                                <label for="categoy" class=" px-2 py-3 text-gray-800 text-md font-semibold mb-2">Sub Category</label>
                                <div class="inline-block relative">
                                    <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        <option v-for="category in subcategories" :value="category.id">
                                            {{category.name}}
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div> 
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
                </div>
            </form>
        </div>

    </div>
  
</template>

<script>
import { serverBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';

    export default {
        name : 'EditModal',
        props: {
            product : {
                type     : Object,
                required : true
            }
        },
        components: {
        },
        data(){
            return {
                myFiles: [],
                name  : '',
                price : 0,
                qty   : 0,
                category : null,
                subcategory : null,
                description : '',
                excerpt     : '',
                categoriesArray    : [],
                subcategories : [],
            }
        },
        mounted() {
        },
        updated() {
        },
        methods: {
          closeModal(){
                serverBus.$emit('close-modal');
          },
        }
    }
</script>
