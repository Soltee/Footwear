<template>
    <div class="">
        
        <div class="relative w-full md:px-12 bg-gray-300 flex flex-col cm:flex-row justify-between ">
            <div class="flex-1 w-full">
              <img class="h-full rounded-lg object-center object-cover w-full " :src="`/storage/${product.imageUrl }`" :alt="`${product.name}`">
            </div>
            <div class="cm:px-6 flex-1 flex flex-col items-center cm:items-start justify-center py-6 md:py-0 ">
                <h3 class="text-3xl font-bold text-gray-900">{{ product.name }}</h3>
                <h5 v-if="category" class="my-4 cm:my-0 text-xl font-bold text-gray-800">{{ category.name }}</h5>
                <h5 class="my-4 cm:my-0 text-xl font-bold text-gray-800">$ {{ product.price }}</h5>
                <div>
                    <div class="flex flex-row items-center justify-between">
                        <input v-model="qty" class="px-2 py-2 w-24 text-center rounded-lg" type="text" name=""  min="1" max="product">
                        <div class="flex flex-col items-center">
                            <svg @click="(qty <= product.qty) ? qty+=1 : ''"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer"><polyline points="18 15 12 9 6 15"></polyline></svg>
                            <svg @click="
                                (qty >= 1 ) ? qty-=1 : 0 " 
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer"><polyline points="6 9 12 15 18 9"></polyline></svg>     
                        </div>
                       
                    </div>
                    <a v-if="message" :href='`/cart-details`' class="text-lg text-gray-900 mr-3">
                            Go To Cart
                    </a>
                    <button @click="addToCart" type="submit" class="mt-4 p-3 rounded-lg text-white text-md hover:opacity-75 bg-black"> Add To Cart</button>
                </div>
            </div>  
        </div>
        
        <div class="flex flex-col my-6">
            <h3 class="text-xl text-gray-900 mb-8 ">Recommended Products</h3>
        
            <div class="embla overflow-x-scroll">
                <div class="embla__container flex">
                <div v-for="recommend in recommended">

                    <div class="embla__slide relative w-64 h-auto p-1 bg-white rounded-lg hover:shadow-md m-2">
                        <a :href="`/shoes/${recommend.id}-${recommend.slug}`">
                            <h3 class="text-lg font-bold my-2 text-gray-900">{{ recommend.name }}</h3>
                            <img class="w-full rounded-lg object-cover object-center" :src="`/storage/${recommend.imageUrl}`">                        
                        </a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import Toast from '../helpers/Alert';
import { serverBus } from '../../app.js';  
import EmblaCarousel from 'embla-carousel';

    export default {
        name : 'add-cart',
        props : ['product', 'category', 'recommended'],
        components : {

        },
        data(){
        	return {
                qty       : 1,
                message   : false,
                err       : false
        	}
        },
        mounted(){
            const emblaNode = document.querySelector('.embla');
            const options = { loop: false };
            const embla = EmblaCarousel(emblaNode, {
              align: 'start',
              containerSelector: '*',
              slidesToScroll: 1,
              containScroll: false,
              draggable: true,
              dragFree: false,
              loop: true,
              speed: 10,
              startIndex: 0,
              selectedClass: 'is-selected',
              draggableClass: 'is-draggable',
              draggingClass: 'is-dragging',
            });
        },
        methods: {
            addToCart(){
                axios.post(`/add-cart/${this.product.id}`, {
                    qty : this.qty
                })
                    .then((res) => {
                        if(res.status == 200){
                            serverBus.$emit('product-added-to-cart', this.qty);
                            Toast.fire({
                              icon: 'success',
                              title:   `Product added to my cart.`
                            });
                            this.message = true;
                            this.removeMessage();
                        }
                    }).catch(error => {
                        this.err = true;
                        this.removeMessage();
                    });

            },
            removeMessage(){
                setTimeout(() => {
                    this.message = false;
                    this.err = false;
                }, 3000);
            }
        }
    }
</script>
<style scoped>
    
</style>
