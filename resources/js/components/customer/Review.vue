<template>
    <div class="z-0 w-full my-6 flex flex-col md:flex-row">
        <div class="w-full md:w-1/2">
            <div v-if="auth" class="relative">
                <div v-if="loading" class="sk-cube-grid">
                    <div class="sk-cube sk-cube1"></div>
                    <div class="sk-cube sk-cube2"></div>
                    <div class="sk-cube sk-cube3"></div>
                    <div class="sk-cube sk-cube4"></div>
                    <div class="sk-cube sk-cube5"></div>
                    <div class="sk-cube sk-cube6"></div>
                    <div class="sk-cube sk-cube7"></div>
                    <div class="sk-cube sk-cube8"></div>
                    <div class="sk-cube sk-cube9"></div>
                </div>
                <!--  Review Form-->
                <form v-else @submit.prevent="review">
                    <h3 class="text-lg font-semibold text-custom-light-black mb-4">Review {{ average ? average : 'Not reviewed.' }}</h3>
                    <div class="mb-4  w-full px-2 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="rating">
                            Rating
                        </label>
                        <star-rating rounded-corners="true" :increment="0.5" v-model="rating"></star-rating>
                    </div>
                    <div class="mb-4  w-full px-2 ">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                            Comment
                        </label>
                        <input class="hadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" type="text" placeholder="Roman" v-model="message">
                    </div>
                    <div class="flex ">
                        <button type="submit" class="mt-3 ml-2 px-6 w-48 md:w-auto py-3 hover:opacity-75 rounded-lg text-white font-bold text-lg bg-custom-light-orange ">Submit</button>
                    </div>
                </form>
            </div>
            <!--  If Not Logged in -->
            <a v-else :href="`/login`" class="my-4 text-custom-light-black text-md border py-2">Login tor review</a>
        </div>
        <div class="w-full md:w-1/2 mt-6 md:mt-0">
            <div class="flex flex-col md:flex-row md:items-start mb-4 w-full">
                <p class="w-full  py-3 rounded text-lg">Reviews</p>
            </div>
            <!-- Loop Reviews-->
            <div v-if="hasReview" class="flex flex-col">
                <div v-for="review in reviews" class="flex flex-row  mb-6">
                    <div class="flex flex-col mr-3 items-center ">
                        <img v-if="review.customer.avatar" class="w-12 md:w-16 object-center object-cover rounded-full" :src="`/storage/customers/${review.customer.avatar}`">
                        <div v-else class="w-12 md:w-16  rounded-full text-transparent">ff</div>
                    </div>
                    <div class="flex flex-col ">
                        <div class="flex flex-col items-start mb-4">
                            <star-rating :rating="review.rating" :star-size="30" :rounded-corners="true" :show-rating="false" :read-only="isNotRated"></star-rating>
                            <h5 class="mt-2 text-sm font-light">{{ review.customer.first_name }}</h5>
                        </div>
                        <p class="text-md leading-6 font-semibold">{{ review.message }}</p>
                    </div>
                </div>
            </div>
            <!-- If Rviews Empty-->
            <div v-else class=" py-2 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="w-16 md:w-24 text-red-500 mb-40">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
                <p class="text-gray-900 text-xl py-3 text-left">No reviews received.</p>
            </div>
        </div>
    </div>
</template>
<script>
import { eventBus } from '../../app.js';
import swal from 'sweetalert';
export default {
    name: 'review',
    props: {
        'auth': {
            type: Object,
            required: false
        },
        'product': {
            type: Object,
            required: true
        }
    },
    component: {

    },
    data() {
        return {
            reviews: [],
            hasReview: false,
            average: 0,
            isNotRated: false,
            reviewed: false,
            rating: 0,
            message: '',
            loading: false
        }
    },
    mounted() {
        this.average = this.product.average_rating;
        this.getReviews();
    },

    methods: {
        review() {
            this.loading = true;
            let data = new FormData();
            data.append('customer_id', this.auth.id);
            data.append('rating', this.rating);
            data.append('message', this.message);

            axios.post(`/product/${this.product.id}/review`, data)
                .then(res => {
                    this.loading = false;
                    if (res.status === 201) {
                        this.reviewed = true;
                        this.isNotRated = false;
                        //Push Review to Reviews array
                        this.reviews.push({
                            customer: this.customer,
                            rating: this.rating,
                            message: this.message,
                        });

                        //Set product Average Rating
                        this.average = res.data.average;
                        //Reset Values
                        this.rating = '';
                        this.message = '';

                        //throw Success message
                        swal({
                            title: "Success!",
                            text: "Thank you for your review.",
                            icon: "success",
                            button: "Close",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: "Error. Please try again later.",
                            icon: "error",
                            button: "Close",
                        });
                    }
                }).catch(err => {
                    swal({
                        title: "Error!",
                        text: "Server Error!",
                        icon: "error",
                        button: "Close",
                    });
                    this.loading = false;
                })
        },
        getReviews() {
            axios.get(`/product/${this.product.id}/reviews`)
                .then(res => {
                    if (res.status === 200) {
                        this.hasReview = res.data.has_reviews;
                        this.reviews = res.data.reviews;
                        // this.isAlreadyreviewed = true;
                    }
                }).catch(err => {});
        }
    }
};

</script>
<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.sk-cube-grid {
    width: 40px;
    height: 40px;
    margin: 100px auto;
}

.sk-cube-grid .sk-cube {
    width: 33%;
    height: 33%;
    background-color: #EE6425;
    float: left;
    -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
    animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
}

.sk-cube-grid .sk-cube1 {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

.sk-cube-grid .sk-cube2 {
    -webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
}

.sk-cube-grid .sk-cube3 {
    -webkit-animation-delay: 0.4s;
    animation-delay: 0.4s;
}

.sk-cube-grid .sk-cube4 {
    -webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;
}

.sk-cube-grid .sk-cube5 {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

.sk-cube-grid .sk-cube6 {
    -webkit-animation-delay: 0.3s;
    animation-delay: 0.3s;
}

.sk-cube-grid .sk-cube7 {
    -webkit-animation-delay: 0s;
    animation-delay: 0s;
}

.sk-cube-grid .sk-cube8 {
    -webkit-animation-delay: 0.1s;
    animation-delay: 0.1s;
}

.sk-cube-grid .sk-cube9 {
    -webkit-animation-delay: 0.2s;
    animation-delay: 0.2s;
}

@-webkit-keyframes sk-cubeGridScaleDelay {

    0%,
    70%,
    100% {
        -webkit-transform: scale3D(1, 1, 1);
        transform: scale3D(1, 1, 1);
    }

    35% {
        -webkit-transform: scale3D(0, 0, 1);
        transform: scale3D(0, 0, 1);
    }
}

@keyframes sk-cubeGridScaleDelay {

    0%,
    70%,
    100% {
        -webkit-transform: scale3D(1, 1, 1);
        transform: scale3D(1, 1, 1);
    }

    35% {
        -webkit-transform: scale3D(0, 0, 1);
        transform: scale3D(0, 0, 1);
    }
}

</style>
