<template>
    <div class="container ">
        <li class="mb-3 mb-0">
            <div class="relative hidden md:inline-flex flex-col justify-left items-center mt-2">
                <div v-if="status">
                    <form @submit.prevent="searchShoes" class="relative flex items-center w-full" >
                        <button type="submit">
                            <svg class="absolute top-0 left-0 mt-0 ml-1 w-8 h-8 p-1 cursor-pointer text-black hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                            </svg>
                        </button>
                        <input type="text"  v-model="key" class="px-2 py-2 px-10 rounded-full w-full" placeholder="Search shoes" />
                        <svg @click="searchAction" class="cursor-pointer text-custom-red-darker absolute top-0 right-0 mt-0 mr-1 w-8 h-8 p-1"  viewBox="0 0 43 43" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <rect x="7.07129" width="50" height="10" rx="5" transform="rotate(45 7.07129 0)" fill="currentColor"/>
                            <rect y="35.3553" width="50" height="10" rx="5" transform="rotate(-45 0 35.3553)" fill="currentColor"/>
                        </svg>
                    </form>
                    <div class="absolute top-0 right-0 mt-8 flex flex-col w-full z-20">
                        <searchResult></searchResult>
                    </div>
                </div>
                <a v-else href="#" class="flex items-center"  @click="status = true;">
                    <svg class="w-8 h-8 text-custom-gray hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                    </svg>
                </a>
                
                
            </div>
            
            <div class="md:hidden relative">
                <form @submit.prevent="searchShoes" class="relative md:hidden relative flex items-center" >
                    <button type="submit">
                        <svg class="absolute top-0 left-0 mt-0 ml-1 w-8 h-8 p-1 cursor-pointer text-black hover:opacity-75" viewBox="0 0 47 49" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M36 20C36 28.8366 28.8366 36 20 36C11.1634 36 4 28.8366 4 20C4 11.1634 11.1634 4 20 4C28.8366 4 36 11.1634 36 20ZM31.8692 36.0989C28.5493 38.5507 24.4439 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20C40 25.1631 38.0436 29.8692 34.8316 33.4175L46.142 44.7279C46.923 45.509 46.923 46.7753 46.142 47.5564C45.3609 48.3374 44.0946 48.3374 43.3136 47.5564L31.9998 36.2426C31.9536 36.1964 31.91 36.1484 31.8692 36.0989Z" fill="currentColor"/>
                        </svg>
                    </button>
                    <input type="text" v-model="key" class="px-2 py-2 px-10 rounded-full w-full" placeholder="Search shoes" :class="(status) ? 'rounded-t-full' : ''" />
                    <svg @click="searchAction" class="cursor-pointer text-custom-red-darker absolute top-0 right-0 mt-0 mr-1 w-8 h-8 p-1"  viewBox="0 0 43 43" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <rect x="7.07129" width="50" height="10" rx="5" transform="rotate(45 7.07129 0)" fill="currentColor"/>
                            <rect y="35.3553" width="50" height="10" rx="5" transform="rotate(-45 0 35.3553)" fill="currentColor"/>
                        </svg>
                </form>
                <div  class="absolute top-0 right-0 mt-8 flex flex-col w-full z-20">
                    <searchResult></searchResult>
                </div>
            </div>
            
        </li>
       
    </div>
</template>

<script>
import { serverBus } from '../../app.js';    
import searchResult from './SearchResult';   
    export default {
        name : 'search',
        props : [],
        directives: {
          focus: {
            // directive definition
            inserted: function (el) {
              el.focus();
            }
          }
        },
        components : {
           searchResult
        },
        data(){
        	return {
                key : "",
                status: false,
                error: null
        	}
        },
        
        methods: {
            async searchAction(){
                this.key = "";
                this.status = false;
                serverBus.$emit('searchClose',  { searchModal :false });
            },
            async emitSearch(event, payload){
                serverBus.$emit(event,  { payload });                 
            },
            async searchShoes(){
                this.status = true;
                this.searching  = true;

                serverBus.$emit('searchStatus',  { searching : true, searchModal :false });
                let key = this.key;
                axios.get(`/searchShoes/${key}`)
                .then(res => {
                    if(res.status == 200){
                        let searching = false;
                        let searchModal = true;
                        let data = res.data;
                        let shoes = data.shoes;
                        let count = data.count;
                        let countResult = data.countResult;
                        serverBus.$emit('search',  { searching, searchModal, shoes, count, countResult, key }); 
                        cosole.log('emitting');
                        // serverBus.$emit('searchClose',  { close : false }); 
                    }
                }).catch(err => {
                    this.err = "There has been some error.";
                    this.removeMessage();
                });
            },  
            async removeMessage(){
                setTimeout(() => {
                    this.message = null;
                    this.err = null;
                }, 3000);
            }
        }
    }
</script>
<style scoped>
    
</style>
