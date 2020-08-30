<template>
    <div class="flex flex-wrap items-center">
        <a v-for="category in categories" :href="`/shoes?category=${category.slug}`" class="mr-4 mb-3 px-6 py-3 bg-custom-light-orange rounded text-white">
            {{ category.name }}
        </a>
        <a v-for="sub in subcategories" :href="`/shoes?subcategory=${sub.slug}`" class="mr-4 mb-3 px-6 py-3 bg-custom-light-orange rounded text-white">
            {{ sub.name }}
        </a>
    </div>
</template>
<script>
import { eventBus } from '../../app.js';
import swal from 'sweetalert';
export default {
    name: 'main-categories',
    props: [],
    data() {
        return {
            categories     : [],
            subcategories  : [],
            csrf           : document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    mounted() {
        this.getCategories();
    },

    methods: {
        getCategories() {
            axios.get('/categories')
            .then(res => {
                if (res.status = 200) {
                    res.data.categories.forEach((c) => {
                        this.categories.push(c);

                        c.subcategories.forEach((s) => {
                            this.subcategories.push(s);
                        });
                    });
                }
            }).catch((err) => {
                this.err = err.data;
            });
        }
    }
};

</script>
<style>

</style>
