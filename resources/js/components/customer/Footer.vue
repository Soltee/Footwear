<template>
    <div class="bg-black px-3 md:px-6 lg:px-12 z-10 py-3 md:py-8">
        
        <div class="flex flex-row">
            <div class="flex flex-col cm:flex-row">
                <div v-for="category in categories" class="mt-3 cm:mt-0 cm:mr-10 flex flex-col items-left rouneded-lg">
                        <a :href="`/shoes?id=${category.id}&category=${category.name}`" class="text-custom-gray hover:opacity-75">
                            <h4 class="text-lg text-gray-light font-bold mb-4">{{ category.name }}</h4>
                        </a>
                        <ul v-for="subcategory in category.subcategories" class="flex flex-col items-left">
                            <li class="mb-2">
                                <a :href="`/shoes?id=${subcategory.id}&subcategory=${subcategory.name}`" class="text-custom-gray hover:opacity-75">

                                    {{subcategory.name}}
                                </a>
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
        
        <div class="flex flex-row items-center">
            <span class="font-sm text-custom-gray-lighter">&copy; Shoe-wear 2019</span>
            <div class="flex flex-row items-center">
                
            </div>
        </div>        
    </div>
</template>

<script>
import request from '../../helpers.js';

    export default {
        name : 'footer-view',
        data(){
        	return {
                categories : null
        	}
        },
        mounted() {
            request('/categories')
            .then(res => {
                if(res.status = 200){
                    this.categories = res.data.categories;  
                }
            }).catch((err) => {
                this.err = err.data;
            });
        }
    };
</script>
<style scoped>
    .translateHide{
        transition: transform 0.3s;
        transform: translateX(100%);
    }
    .translateShow{
        transform: translateX(0);
    }
</style>
