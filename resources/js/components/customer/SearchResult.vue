<template>
    <div class="flex flex-col">
        <div v-if="searching">
            <span class="mt-2 text-md font-bold text-custom-gray">Searching ...</span>
        </div>
        <div v-else>
            <div>
                <div v-if="searchCount" class="md:absolute top-0 left-0 md:mt-12 bg-custom-gray flex flex-col md:w-full mt-2 h-64 overflow-y-scroll overflow-x-auto rounded-lg p-2">
                    <div v-for="shoe in shoes">
                        <div class="flex flex-row justify-around items-center h-auto py-1">
                            <img class="h-12 w-12 rounded-lg object-cover object-center" :src="`/storage/${shoe.imageUrl}`">
                            <a :href="`/shoes/${shoe.id}-${shoe.name}`" class="text-black opacity-75 text-md ml-2" >{{ shoe.name }}</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
        
            
</template>

<script>
import { serverBus } from '../../app.js';    
    export default {
        name : 'searchResult',
        props : ['searching', 'shoes', 'searchCount'],
        data(){
        	return {
                close : false
        	}
        },
        created(){
            serverBus.$on('searchClose', (close) => {
                this.close  = close;
                console.log("Emitted");
            });
        }
    }
</script>
<style scoped>
    
</style>
