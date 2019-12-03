<template>
    <div class="relative">
        
        <svg v-if="menuStatus" @click="menuStatus = false; $emit('searchClose', {close:false});" class="block md:hidden w-8 h-8 text-custom-gray cursor-pointer hover:text-custom-gray-lighter" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
        <svg v-else @click="menuStatus = true" class="block md:hidden w-8 h-8 text-custom-gray cursor-pointer hover:text-custom-gray-lighter" viewBox="0 0 34 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.798828" width="33.2015" height="4" rx="2" fill="currentColor"/>
            <rect x="0.798828" y="12" width="33.2015" height="4" rx="2" fill="currentColor"/>
            <rect x="0.798828" y="24" width="33.2015" height="4" rx="2" fill="currentColor"/>
        </svg>
        <div v-if="menuStatus" class="absolute top-0 right-0 w-48 mt-12 md:hidden">

           <ListItems :customer="customer"></ListItems>

        
        </div> 
        <div class="hidden md:inline-flex">

           <ListItems :customer="customer"></ListItems>

        </div>       

    </div>
</template>

<script>
import ListItems from './ListItems';

    export default {
        name : 'Navmenu',
        props : ['customer'],
        components: {
            ListItems
        },
        data(){
        	return {
                menuStatus : false
        	}
        }
    }
</script>
<style scoped>
</style>
