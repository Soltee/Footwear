<template>
	<div class="fixed inset-0   rounded-lg flex flex-col  justify-center rounded-lg z-20">
        <div class="h-full w-full bg-gray-300" @click="closeModal">
            
        </div>
		<div class="absolute  bg-white left-0 right-0 mx-auto max-w-3xl shadow-lg rounded-lg p-3 ">
			<div class="mb-3 text-right">
                <button @click="closeModal" type="button" class="px-4 py-2 cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>
            </div>

            <div v-if="type == 'product'" class="overflow-y-scroll h-86">
                <div class="flex flex-col md:flex-row justify-around items-center">
                    <img :src="`/storage/${item.imageUrl}`" class="w-64 h-64 rounded-lg">
                    <div class="flex-1 flex flex-col ml-2">
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Name</span>
                            <span class="text-lg font-lg text-gray-900">{{ item.name}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Price</span>
                            <span class="text-lg font-lg text-gray-900">{{ item.price}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Quantity</span>
                            <span class="text-lg font-lg text-gray-900">{{ item.qty}}</span>
                        </div>
                    </div>
                </div>

                <div class="embla overflow-x-scroll w-full">
                    <div class="embla__container flex">
                    <div v-for="image in images">

                        <div class="embla__slide relative w-64 h-auto p-1 bg-white rounded-lg hover:shadow-md m-2">
                            <img class="w-full rounded-lg object-cover object-center" :src="`/storage/${image.thumbnail}`">                        
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div v-if="type == 'customer'" class="overflow-y-scroll h-86">
              <div class="flex flex-col md:flex-row justify-around items-center">
                    <img :src="`/storage/${customer.avatar}`" class="w-64 h-64 rounded-lg">
                    <div class="flex-1 flex flex-col ml-2">
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Name</span>
                            <span class="text-lg font-lg text-gray-900">{{ customer.name}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Email</span>
                            <span class="text-lg font-lg text-gray-900">{{ customer.price}}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-md font-md text-gray-800 w-40">Registered At</span>
                            <span class="text-lg font-lg text-gray-900">{{ format(customer.created_at) }}</span>
                        </div>
                    </div>
                </div>

            </div>

		</div>
		
	</div>
</template>
<script>
import { serverBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';
import EmblaCarousel from 'embla-carousel';
import moment from 'moment';

    export default {
        name       : 'view',
        props      : ['type', 'data'],
        components : { 
            Toast 
        },
        data(){
        	return{
              customer : {},
              item   : {},
              images : [],
        	}
        },
        mounted(){
          let endpoint = '/admin';

          if(this.type == 'product'){
            endpoint += `/products/${this.data.id}`;
          } else if(this.type == 'customer'){
            endpoint += `/customers/${this.data.id}`;            
          }
        	axios.get(`${endpoint}`)
                .then(res => {
                    let data = res.data
                    if(res.status == 200){
                      if(this.type == 'product'){
                        this.item = data.product;
                        this.images = data.images;
                      } else if(this.type == 'customer'){
                        this.customer = data.customer;
                      }
                        
                    } else {
                        Toast.fire({
                          icon: 'error',
                          title: 'Network Error!'
                        });
                    }
                }).catch(err => {
                    Toast.fire({
                      icon: 'error',
                      title: 'Network Error!'
                    });
                });


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
        	closeModal(){
            serverBus.$emit('close-modal');
          },
          format(date) {
            return moment().format(date);
          }
        }
    }
</script>
<style>
	
</style>