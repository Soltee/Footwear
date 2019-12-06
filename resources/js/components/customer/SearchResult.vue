<template>
    <div class="flex flex-col w-full">
        <div v-if="searching" class="mt-4 flex flex-col bg-custom-gray  rounded-lg p-2 w-full"> 
            <span  class=" text-md font-bold text-black opacity-75">
               Searching ....
            </span>
        </div>
        <div v-else class="flex flex-col w-full">
            
            <div v-if="searchModal">
                <div v-if="countResult" class="bg-custom-gray flex flex-col md:w-full mt-2 min-h-0 max-h-24 overflow-y-scroll overflow-x-auto rounded-lg p-2">
                    <div v-for="shoe in shoes">
                        <div class="flex flex-row justify-around items-center h-auto py-1">
                            <img class="h-12 w-12 rounded-lg object-cover object-center" :src="`/storage/${shoe.imageUrl}`">
                            <a :href="`/shoes/${shoe.id}-${shoe.name}`" class="text-black opacity-75 text-md ml-2" >{{ shoe.name }}</a>
                        </div>
                    </div>
                </div>

                <div class="mt-2 p-2 bg-custom-gray rounded-lg">
                    <span class="font-bold font-lg" :class="(countResult) ? '' : 'text-red-700'">{{ count }}</span> found for <span class="font-bold text-lg text-black opacity-75">{{ key }}</span>
                </div>
            </div>
            
        </div>
        
        
    </div>
        
            
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'searchResult',
        data(){
        	return {
                searching : false,
                searchModal : false,
                shoes : null,
                count : 0,
                key : "",
                countResult : false,
        	}
        },
        created(){
            serverBus.$on('searchStatus', (s) => {
                console.log(s);
                this.searching = s.searching;
                this.searchModal = s.searchModal;
            });
            serverBus.$on('search', (result) => {
                console.log(result);
                this.searching = result.searching;
                this.searchModal = result.searchModal;
                this.shoes = result.shoes;
                this.count = result.count;
                this.countResult = result.countResult;
                this.key = result.key;
                console.log("Emitted");
            });
            serverBus.$on('searchClose', (result) => {
                console.log(result);
                this.searchModal = result.searchModal;
                this.key = "";
                this.shoes  = null;
            });
        }
    }
</script>
<style scoped>
    
</style>
