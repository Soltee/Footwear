<template>
    <div class="">
        <div v-if="isAdded">
            <a :href='`/cart-details`'>
                <span class="p-2 rounded-lg text-white text-md cursor-not-allowed bg-green-900 opacity-50">In Cart</span>
            </a>
        </div>
        <form v-else @submit.prevent="addToCart">
            <button type="submit" :class="(isAdded) ? 'cursor-not-allowed  opacity-50' : 'bg-custom-light-orange'" class="p-3  rounded-lg text-white text-md hover:opacity-75"> Add to Cart</button>
        </form>
    </div>
</template>
<script>
import Toast from '../helpers/Alert';
import { eventBus } from '../../app.js';
export default {
    name: 'add-to-cart',
    props: ['product'],
    components: {

    },
    data() {
        return {
            isAdded: false,
            err: null
        }
    },
    mounted() {
        this.isProductAlreadyAdded();
    },
    methods: {
        addToCart() {
            axios.get(`/add-to-cart/${this.product.id}`)
                .then((res) => {
                    if (res.status == 200) {
                        eventBus.$emit('product-added-to-cart');
                        this.isAdded = true;
                        Toast.fire({
                            icon: 'success',
                            title: `Product added to my cart.`
                        });
                    }
                }).catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: `There was some error.`
                    });
                });

        },
        isProductAlreadyAdded() {
            axios.get(`/is-already-added/${this.product.id}`)
                .then((res) => {
                    if (res.data.isAdded) {
                        this.isAdded = true;
                    } else {
                        this.isAdded = false;
                    }
                }).catch(error => {
                    Toast.fire({
                        icon: 'error',
                        title: `There was some error.`
                    });
                });
        }
    }
};

</script>
<style scoped>
</style>
