<template>

    <div class="fixed inset-0 mx-auto max-w-md rounded-lg flex flex-col  justify-center rounded-lg ">
       <div class="bg-white  shadow-lg rounded-lg p-3">
            <div class="mb-3 text-right">
                <button @click="closeModal" type="button" class="px-4 py-3 cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>

            </div>
            <p class="text-lg font-semibold text-green-800 text-center">Are you sure? You want to delete {{ product.name }}</p>
            <div class="mt-6 mb-3 flex justify-end">
                <button @click="closeModal" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
                <button @click="dropProduct(product)" class="cursor-pointer bg-admin-red hover:bg-custom-red-lighter text-white px-4 py-3 rounded-lg">Delete</button>
            </div>
        </div>

    </div>
  
</template>

<script>
import { serverBus } from '../../app.js';    
import Toast from './Alert';

    export default {
        name : 'DeleteModal',
        props: {
            product : {
                type     : Object,
                required : true
            }
        },
        mounted() {
        },
        methods: {
        	closeModal(){
                serverBus.$emit('close-modal');
            },
            dropProduct(product){
                axios.delete(`/admin/products/${this.product.id}`)
                    .then(res=>{
                        if(res.status == 204){
                            serverBus.$emit('success', this.product);
                            Toast.fire({
                              icon: 'success',
                              title:   `Product  deleted.`
                            });
                        }
                    }).catch((error) => {
                        Toast.fire({
                              icon: 'error',
                              title:   `Product was unable to delete.`
                        }); 
                        this.closeModal();
                    });
            }
        }
    }
</script>
