<template>
    <div class="w-auto mb-6">
        <div class="mb-2">
            
            
            <div class="w-full flex flex-col  sm:flex-row sm:justify-between items-center">
                <div class="w-full flex flex-row justify-between items-center sm:w-auto mb-2 sm:mb-0">
                    <div class="flex flex-row items-center"> 
                        <h3 class="text-admin-btn text-lg font-bold">Categories</h3>
                        <svg v-if="!categoryStatus" @click="categoryStatus = true;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 ml-2 cursor-pointer"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        <svg v-if="categoryStatus" @click="categoryStatus = false;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 ml-2 cursor-pointer"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                    <button @click="createModal = true; type='category'" type="button"  class="ml-2 hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-2 px-4 rounded-tl-lg  rounded-br-lg focus:outline-none focus:shadow-outline" >
                        New 
                    </button> 
                </div>
                <div class="w-full flex flex-row justify-between items-center sm:w-auto">
                    <svg @click="selectedCategory =  null; category = ''; reset();" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 mr-2 cursor-pointer"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                
                    <div class="relative flex items-center">
                        

                        <input
                            v-model="category"
                            @keyup="searchStatus = true; categoryStatus = true; getCategories();"
                            class="relative w-40 md:w-32  block appearance-none rounded-full  bg-white border border-gray-400 hover:border-gray-500 pl-16 py-2 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline" id="" type="text" name="name"

                            placeholder="Search Table">
                        <svg class="absolute left-0 top-0 mt-1 ml-2 h-8 w-8" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M37.2309 30.1598C38.9903 27.1823 40 23.709 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40C23.709 40 27.1823 38.9904 30.1598 37.2309L37.7487 44.8198C39.7014 46.7724 42.8672 46.7724 44.8198 44.8198C46.7724 42.8672 46.7724 39.7014 44.8198 37.7487L37.2309 30.1598Z" fill="#201E16"/>
                            <circle opacity="0.3" cx="20" cy="20" r="15" fill="white"/>
                        </svg>
                        <svg @click="searchStatus = false; category = '';" xmlns="http://www.w3.org/2000/svg" class="absolute right-0 top-0 mt-1 mr-2 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </div>
                </div>
            </div>

            <div v-if="categoryStatus"> 
                
                <div class="overflow-x-scroll w-full mt-6 md:overflow-hidden">
                    
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-white rounded-lg">
                              <th class="px-4 py-3 text-left text-gray-900">Name</th>
                              <th class="px-4 py-3 text-left text-gray-900">Created At</th>
                              <th class="px-4 py-3 text-left text-gray-900">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr v-if="searchStatus && (categorySearchArray.length > 0)" v-for="category in categorySearchArray" class="relative">

                              <td  class="border px-4 py-2 text-gray-900">{{ category.name }}</td>
                              <td class="border px-4 py-2 text-gray-900">{{ category.created_at }}</td>
                              <td class="">
                                <div class="flex justify-around items-center">
                                    
                                    <svg @click="type = 'category'; displayEditModal(category)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 cursor-pointer"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <svg @click="selectedCategory = category; categoryStatus = false; getSubCategories();" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 hover:text-green-600 cursor-pointer" fill="currentColor" :class="" viewBox="0 0 24 24"><path d="M0 11c.511-6.158 5.685-11 12-11s11.489 4.842 12 11h-2.009c-.506-5.046-4.793-9-9.991-9s-9.485 3.954-9.991 9h-2.009zm21.991 2c-.506 5.046-4.793 9-9.991 9s-9.485-3.954-9.991-9h-2.009c.511 6.158 5.685 11 12 11s11.489-4.842 12-11h-2.009z"/></svg>
                                    <svg @click="type = 'category';  displayDeleteModal(category)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </div>
                              </td>
                            </tr>

                            <tr v-else>
                              <td class="border px-4 py-2 text-gray-900">
                                No match found.
                              </td>
                            </tr>

                            <tr v-if="!searchStatus && (categoryArray.length > 0)" v-for="category in categoryArray">
                              <td class="border px-4 py-2 text-gray-900">{{ category.name }}</td>
                              <td class="border px-4 py-2 text-gray-900">{{ category.created_at }}</td>
                              <td class="">
                                <div class="flex justify-around items-center">  
                                    
                                    <svg @click="type = 'category'; displayEditModal(category)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 cursor-pointer"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <svg @click="selectedCategory = category; categoryStatus = false; getSubCategories();" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800 hover:text-green-600 cursor-pointer" fill="currentColor" :class="" viewBox="0 0 24 24"><path d="M0 11c.511-6.158 5.685-11 12-11s11.489 4.842 12 11h-2.009c-.506-5.046-4.793-9-9.991-9s-9.485 3.954-9.991 9h-2.009zm21.991 2c-.506 5.046-4.793 9-9.991 9s-9.485-3.954-9.991-9h-2.009c.511 6.158 5.685 11 12 11s11.489-4.842 12-11h-2.009z"/></svg>
                                    <svg @click="type = 'category'; displayDeleteModal(category)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </div>
                              </td>
                            </tr>
                            <tr v-else>
                              <td class="border px-4 py-2 text-gray-900">
                                Empty.
                              </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Paginaion -->
                    <div v-if="searchStatus && (categorySearchArray.length > 4)" >
                        <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="searchLinks">      
                            <div class="flex flex-row items-center">
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ searchLinks.first_item }} </span>
                                <span class="font-semibold text-md text-gray-700"> of </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ searchLinks.last_item }}</span>
                                <span class="font-semibold text-md text-gray-700"> in </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ searchLinks.total_count }}</span>
                            </div>
                            <div>
                                <button  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = searchLinks.previous_page_url; getCategories()" :class="(!searchLinks.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                                <span class="text-gray-800 mx-4 font-semibold">{{ searchLinks.current_page }}</span>
                                <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = searchLinks.next_page_url; getCategories()" :class="(!searchLinks.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                            </div>
                        </div>
                    </div>
                    <div v-if="!searchStatus && (categoryArray.length > 4)" >
                        <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="links">      
                            <div class="flex flex-row items-center">
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ links.first_item }} </span>
                                <span class="font-semibold text-md text-gray-700"> of </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ links.last_item }}</span>
                                <span class="font-semibold text-md text-gray-700"> in </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ links.total_count }}</span>
                            </div>
                            <div>
                                <button  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = links.previous_page_url; getCategories()" :class="(!links.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                                <span class="text-gray-800 mx-4 font-semibold">{{ links.current_page }}</span>
                                <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="page = links.next_page_url; getCategories()" :class="(!links.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="my-6">
            <div class="w-full flex flex-col  sm:flex-row sm:justify-between items-center">
                <div class="w-full flex flex-row justify-between items-center sm:w-auto mb-2 sm:mb-0">
                    <div class="flex flex-row items-center"> 
                        <h3 class="text-admin-btn text-lg font-bold">SubCategories</h3>
                        <svg v-if="!subcategoryStatus" @click="subcategoryStatus = true;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 ml-2 cursor-pointer"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        <svg v-if="subcategoryStatus" @click="subcategoryStatus = false;" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 ml-2 cursor-pointer"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                    <button @click="createModal = true; type='subcategory' " type="button"  class="ml-2 hover:bg-gray-300 bg-admin-btn hover:bg-admin-btn-hover text-gray-100 font-bold py-2 px-4 rounded-tl-lg  rounded-br-lg focus:outline-none focus:shadow-outline" >
                        New 
                    </button> 
                </div>
                <div class="w-full flex flex-row justify-between items-center sm:w-auto">
                    <svg @click="subcategory = '';" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 mr-2 cursor-pointer"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                    
                    <div class="relative flex items-center">
                        

                        <input
                            v-model="subcategory"
                            @keyup="subSearchStatus = true; getSubCategories();"
                            class="relative w-40 md:w-32  block appearance-none rounded-full  bg-white border border-gray-400 hover:border-gray-500 pl-16 py-2 pr-8  shadow leading-tight focus:outline-none focus:shadow-outline" id="" type="text" name="name"

                            placeholder="Search Table">
                        <svg class="absolute left-0 top-0 mt-1 ml-2 h-8 w-8" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M37.2309 30.1598C38.9903 27.1823 40 23.709 40 20C40 8.9543 31.0457 0 20 0C8.9543 0 0 8.9543 0 20C0 31.0457 8.9543 40 20 40C23.709 40 27.1823 38.9904 30.1598 37.2309L37.7487 44.8198C39.7014 46.7724 42.8672 46.7724 44.8198 44.8198C46.7724 42.8672 46.7724 39.7014 44.8198 37.7487L37.2309 30.1598Z" fill="#201E16"/>
                            <circle opacity="0.3" cx="20" cy="20" r="15" fill="white"/>
                        </svg>
                        <svg @click="subSearchStatus = false; subcategory = '';" xmlns="http://www.w3.org/2000/svg" class="absolute right-0 top-0 mt-1 mr-2 h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </div>
                </div>
            </div>

            <div v-if="subcategoryStatus"> 
                
                <div class="overflow-x-scroll w-full mt-6 md:overflow-hidden">
                    
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-white rounded-lg">
                              <th class="px-4 py-3 text-left text-gray-900">Name</th>
                              <th class="px-4 py-3 text-left text-gray-900">Created At</th>
                              <th class="px-4 py-3 text-left text-gray-900">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                            <tr v-if="subSearchStatus && (subcategorySearchArray.length > 0)" v-for="subcategory in subcategorySearchArray">
                              <td class="border px-4 py-2 text-gray-900">{{ subcategory.name }}</td>
                              <td class="border px-4 py-2 text-gray-900">{{ subcategory.created_at }}</td>
                              <td class="">
                                <div class="flex justify-around items-center">
                                    
                                    <svg @click="type = 'subcategory'; displayEditModal(subcategory)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 cursor-pointer"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <svg @click="type = 'subcategory'; displayDeleteModal(subcategory)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </div>
                              </td>
                            </tr>
                            <tr v-else>
                              <td class="border px-4 py-2 text-gray-900">
                                No match found.
                              </td>
                            </tr>

                            <tr v-if="!subSearchStatus && (subcategoryArray.length > 0)" v-for="subcategory in subcategoryArray">
                              <td class="border px-4 py-2 text-gray-900">{{ subcategory.name }}</td>
                              <td class="border px-4 py-2 text-gray-900">{{ subcategory.created_at }}</td>
                              <td class="">
                                <div class="flex justify-around items-center">  
                                    
                                    <svg @click="type = 'subcategory'; displayEditModal(subcategory)" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 cursor-pointer"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    <svg @click="type = 'subcategory'; displayDeleteModal(subcategory)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-1 md:mb-0 h-6 w-6 md:h-8 md:h-8 text-admin-red"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                                </div>
                              </td>
                            </tr>

                            <tr v-else>
                                <td class="border px-4 py-2 text-gray-900">
                                    Empty
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Paginaion -->
                    <div v-if="subSearchStatus && (subcategorySearchArray.length > 4)">
                        <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="subCatsearchLinks">      
                            <div class="flex flex-row items-center">
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ subCatsearchLinks.first_item }} </span>
                                <span class="font-semibold text-md text-gray-700"> of </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ subCatsearchLinks.last_item }}</span>
                                <span class="font-semibold text-md text-gray-700"> in </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ subCatsearchLinks.total_count }}</span>
                            </div>
                            <div>
                                <button  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="subpage = subCatsearchLinks.previous_page_url; getSubCategories()" :class="(!subCatsearchLinks.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                                <span class="text-gray-800 mx-4 font-semibold">{{ subCatsearchLinks.current_page }}</span>
                                <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="subpage = subCatsearchLinks.next_page_url; getSubCategories()" :class="(!subCatsearchLinks.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                            </div>
                        </div>
                    </div>
                    <div v-if="!subSearchStatus && (subcategoryArray.length > 4)">
                        <div class="my-6 flex flex-col md:flex-row justify-between items-center" v-if="sublinks">      
                            <div class="flex flex-row items-center">
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg">{{ sublinks.first_item }} </span>
                                <span class="font-semibold text-md text-gray-700"> of </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ sublinks.last_item }}</span>
                                <span class="font-semibold text-md text-gray-700"> in </span>
                                <span class="px-4 py-3 text-gray-800 font-bold text-lg"> {{ sublinks.total_count }}</span>
                            </div>
                            <div>
                                <button  class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="subpage = sublinks.previous_page_url; getSubCategories()" :class="(!sublinks.previous_page_url) ? 'cursor-not-allowed' : ''">Prev</button>
                                <span class="text-gray-800 mx-4 font-semibold">{{ sublinks.current_page }}</span>
                                <button class="px-4 py-3 rounded-full text-white bg-admin-btn hover:bg-admin-btn-hover" @click="subpage = sublinks.next_page_url; getSubCategories()" :class="(!sublinks.next_page_url) ? 'cursor-not-allowed' : ''">Next</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
            
        <div v-if="deleteModal">
            <DeleteModal :type="selected"></DeleteModal>
        </div>
        <div v-if="createModal">
            <CreateModal :type="type"></CreateModal>
        </div>
        <div v-if="editModal">
            <EditModal :type="type" :data="selected"></EditModal>
        </div>
    </div>
</template>

<script>
import { serverBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';
import CreateModal from './Create';
import EditModal from './Edit';
import DeleteModal from '../helpers/DeleteModal';

    export default {
        name : 'categories-view',
        components : {
            DeleteModal, CreateModal, EditModal
        },
        data(){
        	return {
                categoryStatus : true,
                selectedCategory : null,
        		categoryArray  : [],
        		links          : null,
                searchStatus    :false,
        		category        : '',
        		categorySearchArray    : [],
                searchLinks    : null,
        		page           : null,
        		selected       : {
                        id : 1,
                        name : 'Name'
                },
                type : "",
                subcategoryStatus : true,
                subcategoryArray  : [],
                sublinks          : null,
                subSearchStatus : false,
                subcategorySearchArray    : [],
                subCatsearchLinks    : null,
                subpage           : null,
                subcategory    : '',
                deleteModal    : false,
                createModal    : false,
                editModal      : false,
        	}
        },
        mounted() {
        	this.getCategories();
            this.getSubCategories();
        },
        created(){
            serverBus.$on('close-modal', ()=>{
                this.closeModal();
            }); 

            serverBus.$on('success', (status)=>{
                this.closeonSuccess();
                this.reset();
            });

            serverBus.$on('drop-type', ()=>{
                this.dropCateSubCat();
            });
        },
        methods: {
        	getCategories(){
                let endpoint = '/admin/getCategories';
                
                
                if(this.searchStatus){
                    endpoint = `/admin/getCategories?search=${this.category}`;
                    if(this.page) {
                        endpoint = `${this.page}&search=${this.category}`;
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
                                this.categorySearchArray = [];
                                data.categories.forEach((category) => {
                                    this.categorySearchArray.push(category);
                                });
                                this.searchLinks = data.paginate;
                            } else {
                                this.categoryArray = [];
                                data.categories.forEach((category) => {
                                    this.categoryArray.push(category);
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
            getSubCategories(){
                let endpoint = '/admin/getSubCategories';
                
                if(this.selectedCategory){
                    endpoint = `/admin/getSubCategories?category=${this.selectedCategory.id}`;
                }
                
                if(this.subSearchStatus){
                    endpoint = `/admin/getSubCategories?search=${this.subcategory}`;
                    if(this.subpage) {
                        endpoint = `${this.subpage}&search=${this.subcategory}`;
                    }
                } else {
                    if(this.subpage){
                        endpoint = this.subpage;
                    }
                }

                
                axios.get(`${endpoint}`)
                    .then(res => {
                        let data = res.data;
                        if(res.status == 200){
                            if(this.selectedCategory){
                                this.subcategoryArray = [];
                                data.subcategories.forEach((subcategory) => {
                                    this.subcategoryArray.push(subcategory);
                                });
                                this.sublinks = data.paginate;
                            } else {
                                if(this.subSearchStatus){
                                    this.subcategorySearchArray = [];
                                    data.subcategories.forEach((subcategory) => {
                                        this.subcategorySearchArray.push(subcategory);
                                    });
                                    this.subCatsearchLinks = data.paginate;
                                } else {
                                    this.subcategoryArray = [];
                                    data.subcategories.forEach((subcategory) => {
                                        this.subcategoryArray.push(subcategory);
                                    });
                                    this.sublinks = data.paginate;
                                }
                            }

                            

                            this.subpage = null;

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
            dropCateSubCat(){
                let endpoint = '/admin';
                if(this.type == 'category'){
                    endpoint += `/categories/${this.selected.id}`;
                } else if(this.type == 'subcategory'){
                    endpoint += `/subcategories/${this.selected.id}`;                    
                }

                axios.delete(`${endpoint}`)
                    .then((res) => {
                        if(res.status == 204){
                            if(this.type == 'category'){
                                Toast.fire({
                                  icon: 'success',
                                  title:   `Category  deleted.`
                                });
                            } else if(this.type == 'subcategory'){
                                Toast.fire({
                                  icon: 'success',
                                  title:   `SubCategory  deleted.`
                                });
                            }
                            this.type = "";
                            this.reset();                            
                        }
                    }).catch((error) => {
                        Toast.fire({
                              icon: 'error',
                              title:   `the delete method was unsuccessful. Please try again later.`
                        }); 
                    });
            },
            displayDeleteModal(type){
                this.deleteModal = true;
                this.selected = type;
            },
            displayEditModal(type){
                this.editModal = true;
                this.selected = type;
            },
            closeModal(){
                this.selected = {};
                this.deleteModal = false;
                this.createModal = false;
                this.editModal = false;
                this.type = '';
            },
            closeonSuccess(){
                Toast.fire({
                  icon: 'success',
                  title:   `Operation successful.`
                });
                this.reset();
            },
            reset(){
                this.type = '';
                this.selected = {};
                this.deleteModal = false;
                this.createModal = false;
                this.editModal = false;
                this.getCategories();
                this.getSubCategories();
            }
        }
    }
</script>
