<template>
    <div class="w-full">
        <div class=" items-center w-full">
            <div class="flex justify-between items-center">
                <h3 class="text-admin-btn text-lg font-bold">Products</h3>
                <div class="ml-3 relative flex items-center">
                    <input v-model="keyword" @keyup="searchStatus = true; getProducts();" class="relative w-40 md:w-64  block appearance-none rounded-full  bg-white border border-gray-400 hover:border-gray-500 pl-16 py-2 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline" id="" type="text" name="name" placeholder="Search Table">
                    <svg class="absolute left-0 top-0 mt-1 ml-2 h-8 w-8 text-custom-light-orange" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <svg @click="searchStatus = false; keyword = '';" xmlns="http://www.w3.org/2000/svg" class="absolute right-0 top-0 mt-1 mr-2 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </div>
            </div>
            <a class="flex flex-row sm:items-center fixed bottom-0 right-0 mr-16 mb-16  text-white md:text-admin-btn bg-admin-btn rounded-full hover:opacity-75
" :href="`/admin/products/create`">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-12 h-12 text-white p-2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </a>
        </div>
        <div>
            <div class="overflow-x-scroll min-w-full mt-6 md:overflow-hidden md:w-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-white rounded-lg">
                            <th class="whitespace-no-wrap px-4 py-3 text-left text-gray-900 whitespace-no-wrap">Image</th>
                            <th class="whitespace-no-wrap px-4 py-3 text-left text-gray-900 whitespace-no-wrap">Name</th>
                            <th class="whitespace-no-wrap px-4 py-3 text-left text-gray-900 whitespace-no-wrap">Price</th>
                            <th class="whitespace-no-wrap px-4 py-3 text-left text-gray-900 whitespace-no-wrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--- Loading -->
                        <div v-if="loading" class="fixed inset-0 z-40 bg-gray-300 flex justify-center items-center">
                            <div class="sk-cube-grid">
                                <div class="sk-cube sk-cube1"></div>
                                <div class="sk-cube sk-cube2"></div>
                                <div class="sk-cube sk-cube3"></div>
                                <div class="sk-cube sk-cube4"></div>
                                <div class="sk-cube sk-cube5"></div>
                                <div class="sk-cube sk-cube6"></div>
                                <div class="sk-cube sk-cube7"></div>
                                <div class="sk-cube sk-cube8"></div>
                                <div class="sk-cube sk-cube9"></div>
                            </div>
                        </div>

                        <!-- Default Products -->
                        <tr v-if="!searchStatus" v-for="p in productArray">
                            <td class="whitespace-no-wrap border px-4 py-2 text-gray-900 whitespace-no-wrap">
                                <a :href="`/admin/reviews/${p.id}`" class="text-blue-500 hover:text-blue-600">
                                    <img class="h-16 w-16 md:h-24 md:w-24 rounded-full" :src="`/${p.imageUrl}`" onerror="this.src='/img/placeholder.png'">
                                </a>
                            </td>
                            <td class="whitespace-no-wrap border px-4 py-2 text-gray-900 whitespace-no-wrap">
                                <a :href="`/admin/reviews/${p.id}`" class="text-blue-500 hover:text-blue-600">{{ p.name }}</a>
                            </td>
                            <td class="whitespace-no-wrap border px-4 py-2 text-gray-900 whitespace-no-wrap">Rs {{ p.price }}</td>
                            <td class="whitespace-no-wrap ">
                                <div class="flex flex-row justify-around items-center">
                                    <svg @click="displayEditModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 cursor-pointer">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    <svg @click="displayDeleteModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red">
                                        <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path>
                                        <line x1="18" y1="9" x2="12" y2="15"></line>
                                        <line x1="12" y1="9" x2="18" y2="15"></line>
                                    </svg>
                                    <svg @click="displayViewModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-gray-600 cursor-pointer ">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                            </td>
                        </tr>

                        <!-- Search Results-->
                        <tr v-if="searchStatus" v-for="p in searchArray">
                            <td class="whitespace-no-wrap border px-4 py-2 text-gray-900 whitespace-no-wrap">
                                <img class="h-24 w-24 rounded-full" :src="`/${p.imageUrl}`">
                            </td>
                            <td class="whitespace-no-wrap border px-4 py-2 text-gray-900 whitespace-no-wrap"><a :href="`/admin/products/${p.id}/show`" class="text-blue-500 hover:text-blue-600">{{ p.name }}</a></td>
                            <td class="whitespace-no-wrap border px-4 py-2 text-gray-900 whitespace-no-wrap">Rs {{ p.price }}</td>
                            <td class="whitespace-no-wrap ">
                                <div class="flex flex-row justify-around items-center">
                                    <svg @click="displayEditModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 cursor-pointer">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    <svg @click="displayDeleteModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red">
                                        <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path>
                                        <line x1="18" y1="9" x2="12" y2="15"></line>
                                        <line x1="12" y1="9" x2="18" y2="15"></line>
                                    </svg>
                                    <svg @click="displayViewModal(p)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-gray-600 cursor-pointer ">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                        <!-- If Search Doesnot Match -->
                        <tr v-if="searchStatus">
                            <div v-if="searchArray.length < 1" class="flex items-center w-full flex-col">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 md:h-24 md:w-24 text-red-500">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                </svg>
                                <p class="text-sm font-semibold text-red-500 mt-4">Product not match.</p>
                            </div>

                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Search Pagination -->
            <div v-if="searchStatus && searchArray.length > 0">
                <div  class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="searchLinks">
                    <div class="flex flex-row items-center">
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ searchLinks.first_item }} </span>
                        <span class="font-semibold text-md text-gray-700"> of </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ searchLinks.last_item }}</span>
                        <span class="font-semibold text-md text-gray-700"> in </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ searchLinks.total_count }}</span>
                    </div>
                    <div>
                        <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = searchLinks.previous_page_url; getProducts()" :class="(!searchLinks.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                        <span class="text-gray-800 mx-4 font-semibold">{{ searchLinks.current_page }}</span>
                        <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = searchLinks.next_page_url; getProducts()" :class="(!searchLinks.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                    </div>
                </div>
            </div>

            <!-- Default Pagination -->
            <div v-if="!searchStatus">
                <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="links">
                    <div class="flex flex-row items-center">
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ links.first_item }} </span>
                        <span class="font-semibold text-md text-gray-700"> of </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ links.last_item }}</span>
                        <span class="font-semibold text-md text-gray-700"> in </span>
                        <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ links.total_count }}</span>
                    </div>
                    <div>
                        <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = links.previous_page_url; getProducts()" :class="(!links.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                        <span class="text-gray-800 mx-4 font-semibold">{{ links.current_page }}</span>
                        <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = links.next_page_url; getProducts()" :class="(!links.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Modals-->
        <div v-if="editModal">
            <EditModal :product="selected"></EditModal>
        </div>
        <div v-if="deleteModal">
            <DeleteModal :type="selected"></DeleteModal>
        </div>
        <div v-if="viewModal">
            <ViewModal type="product" :data="selected"></ViewModal>
        </div>
    </div>
</template>
<script>
import { eventBus } from '../../../app.js';
import Toast from '../../helpers/Alert';
import EditModal from '../helpers/EditModal';
import DeleteModal from '../helpers/DeleteModal';
import ViewModal from '../helpers/ViewModal';

export default {
    name: 'products-view',
    components: {
        EditModal,
        DeleteModal,
        ViewModal
    },
    data() {
        return {
            loading : false,
            productArray: [],
            links: null,
            searchStatus: false,
            keyword: '',
            searchArray: [],
            searchLinks: null,
            page: null,
            selected: {
                id: 1,
                name: 'Name'
            },
            deleteModal: false,
            editModal: false,
            viewModal: false
        }
    },
    mounted() {
        this.getProducts();
    },
    created() {
        eventBus.$on('close-modal', () => {
            this.closeModal();
        });
        eventBus.$on('drop-type', () => {
            console.log('hhh');
            this.dropProduct();
        });
    },
    methods: {
        getProducts() {
            this.loading = true;
            let endpoint = '/admin/getProducts';


            if (this.searchStatus) {
                endpoint = `/admin/getProducts?search=${this.keyword}`;
                if (this.page) {
                    endpoint = `${this.page}&search=${this.keyword}`;
                }
            } else {
                this.searchStatus = false;
                if (this.page) {
                    endpoint = this.page;
                }
            }


            axios.get(`${endpoint}`)
                .then(res => {
                    this.loading = false;
                    let data = res.data;
                    if (res.status == 200) {
                        if (this.searchStatus) {
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
                    this.loading = false;
                    Toast.fire({
                        icon: 'error',
                        title: 'Network Error!'
                    });
                });
        },
        dropProduct() {
            console.log('hhh2');
            axios.delete(`/admin/products/${this.selected.id}`)
                .then(res => {
                    if (res.status == 204) {
                        Toast.fire({
                            icon: 'success',
                            title: `Product  deleted.`
                        });
                        this.closeOnSuccess();
                    }
                }).catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: `Product was unable to delete.`
                    });
                    this.closeModal();
                });
        },
        ifExists(page) {
            if (!page) { return 'No page.' } else { return page; }
        },
        displayDeleteModal(product) {
            this.deleteModal = !this.deleteModal;
            this.selected = product;
            console.log(this.selected);
        },
        displayEditModal(product) {
            this.editModal = !this.editModal;
            this.selected = product;
        },
        displayViewModal(product) {
            this.viewModal = !this.viewModal;
            this.selected = product;
        },
        closeOnSuccess() {
            this.selected = {};
            this.deleteModal = false;
            this.editModal = false;
            this.getProducts();
        },
        closeModal() {
            this.selected = {};
            this.deleteModal = false;
            this.editModal = false;
            this.viewModal = false;
        },

    }
};

</script>
<style>
.custom-fixed {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100vh;
}

</style>
