<template>
    <div class="w-full">
    
        <div class="flex flex-row justify-between items-center w-full rounded-lg">
            <h3 class="text-admin-btn text-lg font-bold">Products</h3>
            <div class="relative flex items-center">
                

                <input
                    v-model="keyword"
                    @keyup="searchStatus = true; getProducts();"
                    class="relative w-40 md:w-64  block appearance-none rounded-full  bg-white border border-gray-400 hover:border-gray-500 pl-16 py-2 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline" id="" type="text" name="name"

                    placeholder="Search Table">
                <svg class="absolute left-0 top-0 mt-1 ml-2 h-8 w-8" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M37.2309 30.1598C38.9903 27.1823 40 23.709 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40C23.709 40 27.1823 38.9904 30.1598 37.2309L37.7487 44.8198C39.7014 46.7724 42.8672 46.7724 44.8198 44.8198C46.7724 42.8672 46.7724 39.7014 44.8198 37.7487L37.2309 30.1598Z" fill="#201E16"/>
                    <circle opacity="0.3" cx="20" cy="20" r="15" fill="white"/>
                </svg>
                <svg @click="searchStatus = false; keyword = '';" xmlns="http://www.w3.org/2000/svg" class="absolute right-0 top-0 mt-1 mr-2 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>

        </div>

        <div> 
            <div class="overflow-x-scroll w-full mt-6 md:overflow-hidden md:w-auto">
                
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                          <th class="px-4 py-3 text-left text-gray-900">Id</th>
                          <th class="px-4 py-3 text-left text-gray-900">Image</th>
                          <th class="px-4 py-3 text-left text-gray-900">Name</th>
                          <th class="px-4 py-3 text-left text-gray-900">Price</th>
                          <th class="px-4 py-3 text-left text-gray-900">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-if="!searchStatus" v-for="p in productArray">
                          <td class="border px-4 py-2 text-gray-900">{{ p.id }}</td>
                          <td class="border px-4 py-2 text-gray-900">
                              <img class="h-16 w-16 md:h-24 md:w-24 rounded-full" :src="`/storage/${p.imageUrl}`">
                          </td>
                          <td class="border px-4 py-2 text-gray-900">{{ p.name }}</td>
                          <td class="border px-4 py-2 text-gray-900">Rs {{ p.price }}</td>
                          <td class="">
                            <div class="flex justify-around items-center">                                
                                <svg @click="displayEditModal(p)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 "><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>

                                <svg @click="displayDeleteModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                            </div>
                          </td>
                        </tr>
                         <tr v-if="searchStatus" v-for="p in searchArray">
                          <td class="border px-4 py-2 text-gray-900">{{ p.id }}</td>
                          <td class="border px-4 py-2 text-gray-900">
                              <img class="h-24 w-24 rounded-full" :src="`/storage/${p.imageUrl}`">
                          </td>
                          <td class="border px-4 py-2 text-gray-900">{{ p.name }}</td>
                          <td class="border px-4 py-2 text-gray-900">Rs {{ p.price }}</td>
                          <td class="">
                            <div class="flex justify-around items-center">                                
                                <svg @click="displayEditModal(p)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 "><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <svg @click="displayDeleteModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>

                            </div>
                          </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <div v-if="searchStatus">
                <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="searchLinks">      
                    <div class="flex flex-row items-center">
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ searchLinks.first_item }} </span>
                        <span class="font-semibold text-md text-gray-700"> of </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ searchLinks.last_item }}</span>
                        <span class="font-semibold text-md text-gray-700"> in </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ searchLinks.total_count }}</span>
                    </div>
                    <div>
                        <button  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = searchLinks.previous_page_url; getProducts()" :class="(!searchLinks.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                        <span class="text-gray-800 mx-4 font-semibold">{{ searchLinks.current_page }}</span>
                        <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = searchLinks.next_page_url; getProducts()" :class="(!searchLinks.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="links">      
                    <div class="flex flex-row items-center">
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ links.first_item }} </span>
                        <span class="font-semibold text-md text-gray-700"> of </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ links.last_item }}</span>
                        <span class="font-semibold text-md text-gray-700"> in </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ links.total_count }}</span>
                    </div>
                    <div>
                        <button  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = links.previous_page_url; getProducts()" :class="(!links.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                        <span class="text-gray-800 mx-4 font-semibold">{{ links.current_page }}</span>
                        <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = links.next_page_url; getProducts()" :class="(!links.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                    </div>
                </div>
            </div>
            
        </div>
        <div v-if="editModal">
            <EditModal :product="selected"></EditModal>
        </div>
        <div v-if="deleteModal">
            <DeleteModal :product="selected"></DeleteModal>
        </div>
        
    </div>
</template>

<script>
import { serverBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';
import EditModal from '../../helpers/EditModal';
import DeleteModal from '../../helpers/DeleteModal';

    export default {
        name : 'products-view',
        components: {
            EditModal, DeleteModal
        },
        data(){
        	return {
        		productArray   : [],
        		links          : null,
                searchStatus   : false,
                keyword        : '',
                searchArray    : [],
                searchLinks    : null,
                page           : null,
                selected       : {},
                deleteModal    : false,
                editModal      : false
        	}
        },
        mounted() {
        	this.getProducts();
        },
        created(){
            serverBus.$on('success', (product)=>{
                this.selected = {};
                this.deleteModal = false;
                this.editModal = false;
                this.getProducts();
            });

            serverBus.$on('close-modal', ()=>{
                this.selected = {};
                this.deleteModal = false;
                this.editModal = false;
            });
        },
        methods: {
            displayDeleteModal(product){
                this.deleteModal = ! this.deleteModal;
                this.selected = product;
                console.log(this.selected);
            },
            displayEditModal(product){
                this.editModal = !this.editModal;
                this.selected = product;
            },
        	getProducts(){
                let endpoint = '/admin/getProducts';
                
                
                if(this.searchStatus){
                    endpoint = `/admin/getProducts?search=${this.keyword}`;
                    if(this.page) {
                        endpoint = `${this.page}&search=${this.keyword}`;
                    }
                } else {
                    if(this.page){
                        endpoint = this.page;
                    }
                }

                
                axios.get(`${endpoint}`)
                    .then(res => {
                        let data = res.data;
                        if(res.status == 200){
                            if(this.searchStatus){
                                this.searchArray = [];
                                data.products.forEach((product) => {
                                    this.searchArray.push(product);
                                });
                                this.searchLinks = data.paginate;
                            } else {
                                this.productArray = [];
                                data.products.forEach((product) => {
                                    this.productArray.push(product);
                                });
                                this.links = data.paginate;
                            }

                            this.page = null;

                        }
                    }).catch(err => {
                        Toast.fire({
                          icon: 'error',
                          title: 'Network Error!'
                        });
                    });
        	},
        	ifExists(page){
        		if(!page){return 'No page.'} else {return page;}
        	},
        	filterProduct(product){
        		
                if(this.searchStatus){
                    this.productArray = this.productArray.filter((state) => {
                        return state.id !== product.id;
                    });
                } else {
                    this.searchArray = this.searchArray.filter((state) => {
                        return state.id !== customer.id;
                    });
                }
        	}
        }
    }
</script>
<style>
    .custom-fixed{
        position: absolute;
        top: 0;
        width: 100%;
        height: 100vh;
    }
</style>