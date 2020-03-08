<template>

    <div class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
        <div class="h-full w-full bg-gray-300" @click="closeModal">
            
        </div>
        <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
            <div class="text-right">
                <button @click="closeModal" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                    <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                      <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </button>

            </div>
            <div class="">
                <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure? You want to delete {{ type.name }}</p>
                <div class="mt-6 mb-3 flex justify-end">
                    <button @click="closeModal" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Cancel</button>
                    <button @click="emit()" class="cursor-pointer bg-admin-red hover:bg-custom-red-lighter text-white px-4 py-3 rounded-lg">Delete</button>
                </div>
            </div>
            
        </div>

    </div>
  
</template>

<script>
import { eventBus } from '../../../app.js';    
import Toast from '../../helpers/Alert';

    export default {
        name : 'DeleteModal',
        props: {
            type : {
                type     : Object,
                required : true
            }
        },

        methods: {
        	closeModal(){
                eventBus.$emit('close-modal');
            },
            emit(){
                eventBus.$emit('drop-type');
            }
        }
    };
</script>
