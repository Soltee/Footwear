<template>
    <div class="container ">
        <button>Add To Cart</button>
        
        <portal to="CartTotal">
            <div class="relative flex items-center">
                <div @click="cartModal = !cartModal" class="relative flex items-center cursor-pointer">
                    <svg class="h-4 w-4 text-gray-300 font-medium text-md" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 2h16l-3 9H4a1 1 0 1 0 0 2h13v2H4a3 3 0 0 1 0-6h.33L3 5 2 2H0V0h3a1 1 0 0 1 1 1v1zm1 18a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm10 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                    <span class="ml-2 p-1 text-md text-white font-bold bg-red-600 rounded-lg">99+</span>
                </div>
                <div v-if="cartModal" class="absolute right-0 top-0 mt-8 p-3 w-64 bg-blue-500 rounded-lg text-white">
                    Cart data
                </div>
            </div>
        </portal>

    </div>
</template>

<script>
    export default {
        name : 'add-to-cart',
        props : [],
        data(){
        	return {
                cartModal : false
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
