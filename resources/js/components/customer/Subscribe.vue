<template>
    <transition name="fade">
        <div v-if="subscribeForm" class="z-0 w-full my-8">
            <div v-if="loading" class="fixed inset-0 z-40 bg-gray-300 flex justify-center items-center">
                <div class="sk-cube-grid">
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
            </div>
            <div v-else class="fixed inset-0 z-40 bg-gray-100 md:my-0 rounded-lg flex flex-col  justify-center rounded z-40">
                <div class="h-full w-full" @click="subscribeForm = false; email = '';">
                </div>
                <div v-if="!subscribed" class="absolute  bg-white left-0 right-0  mx-auto  max-w-4xl shadow rounded-lg z-30 flex flex-row items-center">
                    <div class="w-full md:w-1/3 hidden md:block">
                        <img class="h-full rounded-l-lg w-full object-cover object-center" :src="`/img/news.jpg`">
                    </div>
                    <div class="w-full md:w-2/3 px-4 py-4 flex flex-col">
                        <h2 class="font-bold text-3xl opacity-75 md:text-4xl text-custom-light-black  mb-4 uppercase">
                            Exciting News and Disounts
                        </h2>
                        <div class="flex mb-6">
                            <input type="checkbox" class="w-8 h-8" name="remember" id="remember">
                            <h5 class="ml-3 text-md text-custom-light-black leading-6">
                                Yes! Sign me up to receive Email Notifications from Foot-wear with the latest deals, sales and updates. I agree to Foot-wear's Terms of Service and 
                            </h5>
                        </div>

                        <form @submit.prevent="subscribe">
                            <div class="mt-4 w-full flex flex-col md:flex-row">
                                <input v-model="email" type="email" class="focus:outline-none  w-full md:w-2/3 bg-white rounded-t md:rounded-t-none md:rounded-l px-6 py-3 sm:mb-0 border focus:border-custom-light-orange" placeholder="Enter email..">
                                <button type="submit" class="focus:outline-none w-full md:w-1/3  bg-custom-light-orange hover:opacity-75 rounded-b md:rounded-b-none md:rounded-r md:uppercase text-white font-bold md:tracking-wide py-3 px-3 md:px-6 text-center cursor-pointer">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div v-else class="absolute  bg-white left-0 right-0  mx-auto  max-w-4xl shadow rounded-lg z-30 flex flex-col items-start px-6 p-6">
                    <h1 class="font-bold text-2xl opacity-75  text-custom-light-black  mb-2">Check your email</h1>
                    <p class="leading-relaxed text-custom-light-black mb-3">We’ve sent a message to {{email}} with a link to activate your account.</p>
                    <p class="leading-relaxed text-custom-light-black mb-1">If you don’t see an email from us within a few minutes, following things could have happened;</p>
                    <li class="list-none mb-2 text-semibold text-custom-light-black"> The email is in your spam folder.</li>
                    <li class="list-none mb-2 text-semibold text-custom-light-black">The email address you entered had a mistake or typo.
                    <li class="list-none mb-2 text-semibold text-custom-light-black">We can’t deliver the email to this address.</li>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
import { eventBus } from '../../app.js';
import swal from 'sweetalert';
export default {
    name: 'subscribe',
    props: [],
    data() {
        return {
            subscribeForm: false,
            subscribed: false,
            fail: false,
            email: '',
            loading: false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    mounted() {
        setTimeout(() => {
            this.subscribeForm = true;
        }, 5000);
    },

    methods: {
        subscribe() {
            this.loading = true;
            let data = new FormData();
            data.append('email', this.email);

            axios.post(`/newsletter/signup`, data)
                .then(res => {
                    this.loading = false;
                    if (res.status === 201) {
                        this.subscribed = true;
                    } else if (res.status === 200) {
                        swal({
                            title: "Error!",
                            text: "You are already on the mailing list!",
                            icon: "error",
                            button: "Close",
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: "Server error!",
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
