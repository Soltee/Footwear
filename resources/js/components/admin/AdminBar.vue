<template>
    <div class="">
        <nav class="py-2 md:py-6 px-3 md:px-10">
            <div class="md:px-0">
                <div class="relative flex items-center justify-between">
                    <div v-if="expandMenu" class="absolute left-0 top-0 mt-16 w-full sm:w-40 md:hidden z-20">
                        <Menu></Menu>
                    </div>
                    <div class="mr-6 flex items-center justify-between">
                        <svg @click="expandMenu = !expandMenu" class="md:hidden w-16 h-16 text-gray-900 cursor-pointer hover:text-custom-gray-lighter" viewBox="0 0 34 28" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.798828" width="33.2015" height="4" rx="2" fill="currentColor" />
                            <rect x="0.798828" y="12" width="33.2015" height="4" rx="2" fill="currentColor" />
                            <rect x="0.798828" y="24" width="33.2015" height="4" rx="2" fill="currentColor" />
                        </svg>
                        <a :href="`/#`" class="ml-3 mt-0 md:-mt-1 md:ml-0 text-lg font-semibold text-gray-100 no-underline mr-3">
                            <svg class="h-12 w-12 md:h-16 md:w-16" viewBox="0 0 95 79" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d)">
                                    <rect y="28.2843" width="8" height="60" rx="4" transform="rotate(-45 0 28.2843)" fill="#201E16" />
                                    <rect y="28.2843" width="40" height="10" rx="5" transform="rotate(-45 0 28.2843)" fill="#201E16" />
                                    <rect x="65.0537" y="48.0833" width="60" height="8" rx="4" transform="rotate(-135 65.0537 48.0833)" fill="#201E16" />
                                    <rect x="17.6777" y="45.9619" width="40" height="10" rx="5" transform="rotate(-45 17.6777 45.9619)" fill="#201E16" />
                                    <rect x="35.3552" y="63.6396" width="40" height="10" rx="5" transform="rotate(-45 35.3552 63.6396)" fill="#201E16" />
                                </g>
                                <defs>
                                    <filter id="filter0_d" x="0" y="0" width="94.7106" height="78.7107" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                        <feOffset dx="20" dy="4" />
                                        <feGaussianBlur stdDeviation="2" />
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                                    </filter>
                                </defs>
                            </svg>
                        </a>
                    </div>
                    <div class="relative flex flex-row items-center text-right">
                        <div class="flex items-center justify-around w-auto px-2 py-1 bg-custom-gray-lighter " :class="(status) ? 'rounded-t-lg' : 'rounded-full'">
                            <img v-if="admin.avatar" :src="`/storage/${admin.avatar}`" class="w-8 h-8 rounded-full object-cover object-center">
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
                <div class="h-full w-full bg-transparent" @click="logoutModal = false;">
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
        }
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
