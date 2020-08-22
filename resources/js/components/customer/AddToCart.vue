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
    </div>
</template>
<script>
import Toast from '../helpers/Alert';
import { eventBus } from '../../app.js';

export default {
    name: 'add-cart',
    props: ['product'],
    data() {
        return {
            added: false,
            qty: 1,
            visible: false,
        }
    },

    methods: {

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

    },


};

</script>
<style lang="scss" scoped>
</style>
