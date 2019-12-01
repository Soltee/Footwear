<template>
    <div class="container ">
       
        <div class="pt-40  container px-6  lg:px-12 z-10  flex flex-col flex-items mt-24">
            <div class="flex items-center">
                <h1 class="text-xl font-semibold text-custom-gray-lighter">Popular</h1>
            </div>
            

            <carousel :responsive="{0:{items:1,nav:false},480:{items:2,nav:false}, 768:{items:3,nav:false}, 1024:{items:5,nav:false}}"  :nav="false" :dots="false">
           
            <div v-for="product in products.data" class="flex-shrink-0 w-full">
                    <div class="w-64">
                        <img class="w-64 object-contain" :src="`/storage/products/${product.imageUrl}`" alt="Popular Products">
                        <h5 class="text-lg text-custom-gray-light">{{ product.name }} </h5>
                    </div>
            </div>
            
            </carousel>


        </div>

    </div>
</template>

<script>
import carousel from 'vue-owl-carousel' 
    export default {
        name : 'welcome',
        props : ['products'],
        components: {
            carousel
        },
        data(){
        	return {
                message   : null,
                err       : null
        	}
        },
        mounted() {
        },
        methods: {
            
        }
    }
</script>
<style scoped>
    
</style>
