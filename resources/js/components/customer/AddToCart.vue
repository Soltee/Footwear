<template>
    <div class="">
        <div>
            <div class="flex flex-row items-center ">
                <input v-model="qty" class="px-2 py-2 w-24 text-center rounded-lg border rounded" type="text" name="" min="1" max="product">
                <div class="flex flex-col items-center">
                    <svg @click="(qty <= product.qty) ? qty+=1 : ''" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer">
                        <polyline points="18 15 12 9 6 15"></polyline>
                    </svg>
                    <svg @click="
                                    (qty >= 1 ) ? qty-=1 : 0 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </div>
            <a v-if="added" :href='`/cart-details`' class="text-lg text-gray-900 mr-3">
                Go To Cart
            </a>
            <button @click="addToCart" type="submit" class="mt-8 px-4 py-3 rounded-lg bg-custom-light-orange text-md
 hover:opacity-75 text-white"> Add To Cart</button>
        </div>
        <!-- <div class="relative w-full   flex flex-col md:flex-row justify-between ">
            <div class="flex-1 flex flex-col items-center justify-around rounded-lg">
                <Swiper class="swiper gallery-top" :options="swiperOptionTop" ref="swiperTop">
                    <SwiperSlide v-for="ig in list" :key="index" class="rounded">
                        <img class="w-full h-full object-cover object-center" :src="`/storage/${ig.imageUrl}`">
                    </SwiperSlide>
                    <div class="swiper-button-next " slot="button-next"></div>
                    <div class=".swiper-button-prev " slot="button-prev"></div>
                </Swiper>
                <!-- <carousel class="example-default" :navigation-arrows="isNavigationKnob">
                    <slide v-for="image in list" :key="id">
                        <img class="w-full h-full object-cover object-center" :src="`/storage/${image.imageUrl}`">
                    </slide>
                </carousel> -->
        <!-- <carousel>
                    <div v-for="(ig, index) in list">
                        <slide :key:"index">
                            <img class="w-full h-full object-cover object-center" :src="`/storage/${ig.imageUrl}`">
                        </slide>
                    </div>
                </carousel> -->
        <!-- <Swiper :options="swiperOption">
                    <SwiperSlide v-for="(ig, index) in list" :key="index">
                        <img class="w-full h-full object-cover object-center" :src="`/storage/${ig.imageUrl}`">
                    </SwiperSlide>
                    <div class="swiper-button-prev" slot="button-prev"></div>
                    <div class="swiper-button-next" slot="button-next"></div>
                </Swiper> -->
        <!-- <div class="cursor-pointer self-center px-8"
                   @click.stop="prev"
                   :class="{'invisible': ! hasPrev()}"> -->
        <!-- <svg @click.stop="prev" class="h-10 w-10  text-gray-800" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"> -->
        <!-- <path d="M7.05 9.293L6.343 10 12 15.657l1.414-1.414L9.172 10l4.242-4.243L12 4.343z" /></svg> -->
        <!-- </div> -->
        <!-- <div class="cursor-pointer self-center px-8"
                   @click.stop="next"
                   :class="{'invisible': ! hasNext()}"> -->
        <!--  <svg @click.stop="next" class=" h-10 w-10 text-gray-800" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" /></svg>> -->
        <!-- </div> -->
        <!-- </div>
            <div class="flex-1 cm:px-3 flex-1 flex flex-col items-center md:items-start justify-center py-6 md:py-0 ">
                <h3 class="text-3xl font-bold text-gray-900">{{ product.name }}</h3>
                <h5 v-if="category" class="my-4 cm:my-0 text-xl font-bold text-gray-800">{{ category.name }}</h5>
                <h5 class="my-4 cm:my-0 text-xl font-bold text-gray-800">$ {{ product.price }}</h5>
                <div>
                    <div class="flex flex-row items-center justify-between">
                        <input v-model="qty" class="px-2 py-2 w-24 text-center rounded-lg" type="text" name="" min="1" max="product">
                        <div class="flex flex-col items-center">
                            <svg @click="(qty <= product.qty) ? qty+=1 : ''" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
                            <svg @click="
                                (qty >= 1 ) ? qty-=1 : 0 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 cursor-pointer">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                    <a v-if="added" :href='`/cart-details`' class="text-lg text-gray-900 mr-3">
                        Go To Cart
                    </a>
                    <button @click="addToCart" type="submit" class="mt-4 p-3 rounded-lg text-white text-md hover:opacity-75 bg-black"> Add To Cart</button>
                </div>
            </div>
        </div> -->
        <!--  <div class="flex flex-col mt-16 mb-6">
            <h3 class="text-xl text-gray-900 mb-8 ">Recommended Products</h3>
            <Swiper class="swiper " :options="swiperOption">
                <SwiperSlide v-for="(ig, index) in list" :key="index" class="rounded">
                    <img class="w-40 h-full object-cover object-center" :src="`/storage/${ig.imageUrl}`">
                </SwiperSlide>
                <div class="swiper-button-next " slot="button-next"></div>
                <div class=".swiper-button-prev " slot="button-prev"></div>
            </Swiper>
            <div class="embla2 overflow-x-scroll h-auto">
                <div class="embla__container flex">
                    <div v-for="recommend in recommended">
                        <div class="embla__slide relative w-64 h-auto p-1 rounded-lg hover:shadow-md m-2">
                            <a :href="`/shoes/${recommend.id}/${recommend.slug}`">
                                <h3 class="text-lg font-bold my-2 text-gray-900">{{ recommend.name }}</h3>
                                <img class="w-64 h-64 rounded-lg object-cover object-center" :src="`/storage/${recommend.imageUrl}`">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>
import Toast from '../helpers/Alert';
import { eventBus } from '../../app.js';
import EmblaCarousel from 'embla-carousel';
// import { tns } from './src/tiny-slider.js';

import { Carousel, Slide } from 'vue-snap'
import 'vue-snap/dist/vue-snap.css'

// import { Slider, SliderItem } from 'vue-easy-slider';
// import { Carousel, Slide } from 'vue-carousel';
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper';
import 'swiper/swiper-bundle.css' // If you use Swiper 6.0.0 or higher

export default {
    name: 'add-cart',
    props: ['product', 'images', 'category', 'recommended'],
    components: {
        Swiper,
        SwiperSlide,
        // tns,
        Carousel,
        Slide
    },
    data() {
        return {
            isNavigationKnob: true,
            swiperOptionTop: {
                loop: true,
                grabCursor: true,
                loopedSlides: 5, // looped slides should be the same
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            },
            swiperOptionThumbs: {
                loop: true,
                loopedSlides: 5, // looped slides should be the same
                spaceBetween: 10,
                centeredSlides: true,
                slidesPerView: 'auto',
                touchRatio: 0.2,
                slideToClickedSlide: true
            },
            swiperOption: {
                slidesPerView: 5,
                spaceBetween: 50,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 40
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    }
                }
            },
            productImage: null,
            list: [],
            added: false,
            qty: 1,
            currentIndex: 0,
            visible: false,
            index: 0,
        }
    },
    mounted() {
        // window.addEventListener('keydown', this.onKeydown)
        // this.pushImage();
        this.list = this.images;
        // // this.setUpEmbla();
        // this.$nextTick(() => {
        //     const swiperTop = this.$refs.swiperTop.$swiper
        //     const swiperThumbs = this.$refs.swiperThumbs.$swiper
        //     swiperTop.controller.control = swiperThumbs
        //     swiperThumbs.controller.control = swiperTop
        // });

        // var slider = tns({
        // container: '.my-slider',
        // items: 1,
        // slideBy: 'page',
        // autoplay: false
        // });

    },
    destroyed() {
        // window.removeEventListener('keydown', this.onKeydown)
    },
    methods: {
        pushImage() {

            // let newArr = [];
            // if (this.productImage !== null) {
            //     newArr = this.images.filter((image) => {
            //         return image.thumbnai !== this.productImage;
            //     });
            // } else {
            //     newArr = this.images;
            // }

            // return this.productImage = newArr[Math.floor(Math.random() * newArr.length)].thumbnail;
        },
        addToCart() {

            axios.post(`/add-cart/${this.product.id}`, {
                    qty: this.qty
                })
                .then((res) => {
                    if (res.status == 200) {
                        this.added = true;
                        eventBus.$emit('product-added-to-cart', this.qty);
                        Toast.fire({
                            icon: 'success',
                            title: `Product added to my cart.`
                        });
                    }
                }).catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: `Server error.`
                    });
                });

        },
        reset() {
            setTimeout(() => {
                this.added = false;
            }, 4000);
        },
        setUpEmbla() {
            const emblaNode2 = document.querySelector('.embla2');
            const options = { loop: false };


            const embla2 = EmblaCarousel(emblaNode2, {
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
        show() {
            this.visible = true;
        },
        hide() {
            this.visible = false;
            this.index = 0;
        },
        hasNext() {
            return this.index + 1 < this.images.length;
        },
        hasPrev() {
            return this.index - 1 >= 0;
        },
        prev() {
            if (this.hasPrev()) {
                this.index -= 1;
            }
        },
        next() {
            if (this.hasNext()) {
                this.index += 1;
            }
        },
        onKeydown(e) {
            if (this.visible) {
                switch (e.key) {
                    case 'ArrowRight':
                        this.next();
                        break;
                    case 'ArrowLeft':
                        this.prev();
                        break;
                    case 'ArrowDown':
                    case 'ArrowUp':
                    case ' ':
                        e.preventDefault();
                        break;
                    case 'Escape':
                        this.hide();
                        break;
                }
            }
        },
    },


};

</script>
<style lang="scss" scoped>
</style>
