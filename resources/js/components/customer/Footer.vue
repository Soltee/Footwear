<template>
    <div class="mt-12 bg-custom-light-black  px-6 py-8 w-full">
        <div class="max-w-screen-lg mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="flex flex-col mb-8">
                    <h3 class="text-white hover:opacity-75 mb-4 text-md pr-3">About</h3>
                    <p class="text-white leading-relaxed">
                        Footwear is a startup just 4 months in business that provides variety of shoes and sneakers from top brands like <a href="http://nike.com">Nike</a> and <a href="http://adidas.com">Adidas</a>.
                    </p>
                    <div class="mt-3 flex items-center">
                        <a :href="`#`" class="text-custom-gray mr-3 hover:opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather w-8 h-8 md:ml-4 feather-twitter">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a :href="`#`" class="text-custom-gray mr-3 hover:opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather w-8 h-8 md:ml-4 feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a :href="`#`" class="text-custom-gray mr-3 hover:opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather w-8 h-8 md:ml-4 feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col mb-8">
                    <h3 class="text-white hover:opacity-75 mb-4 text-md pr-3">Categories</h3>
                    <div class="flex flex-col md:flex-row">
                        <div v-for="category in categories" class="w-32 mt-3 cm:mt-0 cm:mr-10 flex flex-col items-left ">
                            <ul v-for="subcategory in category.subcategories" class="flex flex-col items-left">
                                <li class="mb-4 md:mb-2">
                                    <a :href="`/shoes?id=${subcategory.id}&subcategory=${subcategory.name}`" class="text-white hover:opacity-75 text-md">
                                        {{subcategory.name}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h3 class="text-white hover:opacity-75 mb-8 text-md  pr-3">Useful Links</h3>
                    <!-- <div class="flex flex-row items-right md:justify-end w-full mt-4">
                        <li class="ml-10">
                            <a :href="`#`" class="text-custom-gray hover:opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather w-12 h-12 md:ml-4 feather-twitter">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="ml-10">
                            <a :href="`#`" class="text-custom-gray hover:opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather w-12 h-12 md:ml-4 feather-facebook">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="ml-10">
                            <a :href="`#`" class="text-custom-gray hover:opacity-75">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather w-12 h-12 md:ml-4 feather-instagram">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </li>
                    </div> -->
                    <div class="flex flex-col items-right md:justify-end w-full mt-4">
                        <li class="mb-4 md:mb-2">
                            <a :href="`/shoes`" class="text-white hover:opacity-75">
                                Shop
                            </a>
                        </li>
                        <li class="mb-4 md:mb-2">
                            <a :href="`/privacy-policy`" class="text-white hover:opacity-75">
                                Privacy Policy
                            </a>
                        </li>
                        <li class="mb-4 md:mb-2">
                            <a :href="`/#`" class="text-white hover:opacity-75">
                                Terms & Conditions
                            </a>
                        </li>
                        <li class="mb-4 md:mb-2">
                            <a :href="`/#`" class="text-white hover:opacity-75">
                                Shipping & Returns
                            </a>
                        </li>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-between items-center mt-12">
                <span class="font-sm text-sm text-white">&copy; Shoe-wear 2019</span>
                <a href="/#" v-scroll-to="`#app`">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white hover:opacity-75" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="16 12 12 8 8 12"></polyline>
                        <line x1="12" y1="16" x2="12" y2="8"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import request from '../../helpers.js';

export default {
    name: 'footer-view',
    props: [],
    data() {
        return {
            categories: null
        }
    },
    mounted() {
        request('/categories')
            .then(res => {
                if (res.status = 200) {
                    this.categories = res.data.categories;
                }
            }).catch((err) => {
                this.err = err.data;
            });
    }
};

</script>
<style scoped>
.translateHide {
    transition: transform 0.3s;
    transform: translateX(100%);
}

.translateShow {
    transform: translateX(0);
}

</style>
