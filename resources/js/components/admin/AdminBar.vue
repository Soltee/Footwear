<template>
    <div class="">
        <nav class="py-2 md:py-6 px-3 md:px-10">
            <div class="md:px-0">
                <div class="relative flex items-center justify-between">
                    <div v-if="expandMenu" class="absolute left-0 top-0 mt-16 w-full sm:w-40 md:hidden z-20  bg-admin-bk">
                        <Menu></Menu>
                    </div>
                    <div class="mr-6 flex items-center justify-between">
                        <svg @click="expandMenu = !expandMenu" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="relative  md:hidden w-8 h-8 text-custom-light-black cursor-pointer hover:opacity-75">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                        <a :href="`/#`" class="ml-3 mt-0 md:-mt-1 md:ml-0 text-lg font-semibold text-gray-100 no-underline mr-3">
                            <img class="h-12 w-12 text-custom-light-black" :src="`/img/logo.svg`">
                        </a>
                    </div>
                    <div class="relative flex flex-row items-center text-right">
                        <div class="flex items-center justify-around w-auto px-2 py-1 bg-custom-gray-lighter " :class="(status) ? 'rounded-t-lg' : 'rounded-full'">
                            <img v-if="admin.avatar" :src="`/storage/${admin.avatar}`" class="w-8 h-8 rounded-full object-cover object-center" onerror="this.src='/img/placeholder.png'">
                            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 rounded-full object-cover object-center">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <svg v-if="status" @click="status = false" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10.707 7.05L10 6.343 4.343 12l1.414 1.414L10 9.172l4.243 4.242L15.657 12z" /></svg>
                            <svg v-else @click="status = true" class="ml-2 h-8 w-8 text-custom-gray cursor-pointer hover:text-custom-gray-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                        </div>
                        <div v-if="status" class="absolute top-0 left-0 md:right-0 mt-10 bg-custom-gray-lighter px-2 py-1 rounded-b-lg w-full flex  flex-col border-gray-300 border-t-2 z-20">
                            <a :href="`/admin/profile`" class="no-underline hover:underline text-white text-md  md:text-lg font-bold p-3">Profile</a>
                            <a @click.prevent="toggleLogoutModel" :href="`/#`" class="no-underline hover:underline text-white text-md  md:text-lg font-bold p-3">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div v-if="logoutModal">
            <div class="fixed inset-0  rounded-lg flex flex-col  justify-center rounded-lg z-20">
                <div class="h-full w-full bg-gray-300 opacity-75" @click="logoutModal = false;">
                </div>
                <div class="absolute  bg-white left-0 right-0  mx-auto  max-w-xl shadow-lg rounded-lg p-6 z-30">
                    <div class="text-right">
                        <button @click="logoutModal = false;" type="button" class=" cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="mt-4 text-lg font-semibold text-green-800 text-center">Are you sure? You want to logout ?</p>
                    <div class="mt-6 mb-3 flex justify-end">
                        <button @click="logoutModal = false;" class="cursor-pointer text-gray-900 px-4 py-3 rounded-lg mr-4">Discard</button>
                        <form :method="`POST`" :action="`/admin/administrator-logout`">
                            <input type="hidden" name="_token" :value="`${csrf}`">
                            <button type="submit" class="cursor-pointer bg-admin-red hover:bg-custom-red-lighter text-white px-4 py-3 rounded-lg">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Menu from './helpers/Nav';

export default {
    name: 'admin-bar',
    props: {
        admin: {
            type: Object,
            required: true
        },

    },
    components: {
        Menu
    },
    data() {
        return {
            status: false,
            expandMenu: false,
            logoutModal: false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
    mounted() {

    },
    methods: {
        toggleLogoutModel() {
            this.logoutModal = !this.logoutModal;
        }
    }
}

</script>
<style scoped>
</style>
