<template>
    <div class="flex items-center w-auto overflow-x-scroll md:overflow-hidden mb-2   rounded pl-0">
        <a v-for="(sub, index) in subcategories" :href="`/shoes?subcategory=${sub.id}`" class="mr-4 px-2 py-2  text-custom-light-orange border-r  border-transparent  hover:border-custom-light-orange hover:opacity-75" >
            {{ sub.name }}
        </a>
    </div>
</template>
<script>
import { eventBus } from '../../app.js';
import swal from 'sweetalert';
export default {
    name: 'categories',
    props: [],
    data() {
        return {
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

                    res.data.subcategories.forEach((s) => {
                        this.subcategories.push(s);
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
