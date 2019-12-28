<template>
	<div class="flex flex-col mb-6">
        <h3 class="text-xl text-gray-900 my-4 ">Recommended Products</h3>
    
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
</template>
<script>
import EmblaCarousel from 'embla-carousel';

    export default {
        name : 'recommended',
        props : ['recommended'],
        data(){
        	return {

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
        }
    };
</script>