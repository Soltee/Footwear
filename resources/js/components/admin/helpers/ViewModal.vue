<template>
	<div class="fixed inset-0   rounded-lg flex flex-col  justify-center rounded-lg z-20">
        <div class="h-full w-full bg-gray-300" @click="closeModal">
            
        </div>
		<div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-3 ">
			<div class="mb-3 text-right">
                <button @click="closeModal" type="button" class="px-4 py-2 cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>
            </div>

            <div class="overflow-y-scroll h-86">

                <img v-for="image in images" :src="`/storage/${image.thumbnail}`">
                {{item}}
            </div>

		</div>
		
	</div>
</template>
<script>
import { serverBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';

    export default {
        name       : 'view-product',
        props      : ['product'],
        components : { Toast },
        data(){
        	return{
                item   : {},
                images : [],
        	}
        },
        mounted(){
        	axios.get(`/admin/products/${this.product.id}`)
                .then(res => {
                    let data = res.data
                    if(res.status == 200){
                        this.item = data.product;
                        this.images = data.images;
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
        },
        methods: {
        	closeModal(){
                serverBus.$emit('close-modal');
            },
        }
    }
</script>
<style>
	
</style>