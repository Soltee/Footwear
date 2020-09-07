<template>
    <div class="z-0 w-full my-8">
        <!-- dfsdf -->
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

        <div v-if="successCharge" class="flex flex-col">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 items-center gap-4">
                <a v-for="pro in otherProducts" class="mb-4 " :href="`/shoes/${ pro.id }/${ pro.slug }`">
                    <img class="w-full object-cover  rounded-lg" :src="`/storage/${pro.imageUrl}`" onerror="this.src='/img/placeholder.png'">
                </a>
            </div>
            <a :href="`/shoes`" class="w-full mt-16  cursor-pointer text-center md:w-auto text-bold text-md bg-custom-light-orange hover:opacity-75 text-white px-6 py-4 rounded-lg">Shop more</a>
        </div>
        <div v-else class="">
            <div v-if="checkoutForm" class="w-full">
                <div class="flex items-center px-2">
                    <div class="flex items-center">
                        <a :href="`/shoes`" class=" text-sm  opacity-75">Back to Shop</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                        <a :href="`/cart-details`" class="  text-sm  text-custom-light-black opacity-75">Cart</a>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-700 mx-2">
                            <polyline points="13 17 18 12 13 7"></polyline>
                            <polyline points="6 17 11 12 6 7"></polyline>
                        </svg>
                        <h4 class="font-semibold text-sm  text-custom-light-black ">Checkout</h4>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between my-8 w-full">
                    <form @submit.prevent="" id="payment-form">
                        <div class="flex-1">
                            <div class="w-full mb-6  border border-gray-300 p-3">
                                <h3 class="text-sm font-semibold text-custom-light-black mb-6 px-2 ">Personal Info</h3>
                                <div class="mb-4  w-full px-2 ">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                                        First Name
                                    </label>
                                    <input class="hadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" type="text" placeholder="Roman"  v-model.trim="$v.firstname.$model">

                                    <div v-if="$v.firstname.$error">
                                        <div class="mt-2 p-2 border text-red-500" v-if="!$v.firstname.required">Field is required.</div>
                                        <div class="p-2 border text-red-500" v-if="!$v.firstname.minLength">Field must have at least {{ $v.firstname.$params.minLength.min }} characters.</div>
                                    </div>
                                </div>
                                <div class="mb-4 w-full px-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                                        Last Name
                                    </label>
                                    <input class="hadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" placeholder="Dide" v-model.trim="$v.lastname.$model">
                                    <div v-if="$v.lastname.$error">
                                        <div class="mt-2 p-2 border text-red-500" v-if="!$v.lastname.required">Field is required.</div>
                                        <div class="p-2 border text-red-500" v-if="!$v.lastname.minLength">Field must have at least {{ $v.lastname.$params.minLength.min }} characters.</div>
                                    </div>

                                </div>
                                <div class="w-full mb-6 px-2">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                        Email
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" v-model.trim="$v.email.$model" type="email" placeholder="Rakesh@gmail.com">

                                    <div v-if="$v.email.$error">
                                        <div class="mt-2 p-2 border text-red-500" v-if="!$v.email.required">Field is required.</div>
                                    </div>
                                    
                                </div>
                                <div class="w-full flex flex-col md:flex-row -mx-3 mb-6 px-2">
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                            City
                                        </label>
                                        <div class="relative">
                                            <select class="block appearance-none w-full  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" v-model.trim="$v.city.$model">
                                                <option>Pokhara</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                            </div>
                                        </div>

                                        <div v-if="$v.city.$error" class="md:hidden">
                                            <div class="mt-2 p-2 border text-red-500" v-if="!$v.city.required">Field is required.</div>
                                        </div>

                                    </div>
                                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street">
                                            Street Address
                                        </label>
                                        <div class="relative">
                                            <input class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="street" type="text" placeholder="Albuquerque" v-model.trim="$v.address.$model">
                                        </div>
                                    </div>

                                    <div v-if="$v.address.$error" class=" md:hidden mt-2">
                                        <div class=" p-2 border text-red-500" v-if="!$v.address.required">Field is required.</div>
                                        <div class="p-2 border text-red-500" v-if="!$v.address.minLength">Field must have at least {{ $v.address.$params.minLength.min }} characters.</div>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-2  hidden md:block flex">
                                <div v-if="$v.city.$error" class="w-1/2">
                                    <div class=" p-2 border text-red-500" v-if="!$v.city.required">Field is required.</div>
                                </div>
                                <div v-if="$v.address.$error" class="w-1/2  md:hidden">
                                    <div class="p-2 border text-red-500" v-if="!$v.address.required">Field is required.</div>
                                    <div class="p-2 border text-red-500" v-if="!$v.address.minLength">Field must have at least {{ $v.address.$params.minLength.min }} characters.</div>
                                </div>
                            </div>
                            <div class="w-full mb-6  border border-gray-300 p-3">
                                <h3 class="text-sm font-semibold text-custom-light-black mb-6 w-full px-2">Payment Method</h3>
                                <div >
                                    <div class="flex items-center mb-4 justify-between rounded w-full border px-4 py-3 border-gray-300 group hover:border-green-600 cursor-pointer" @click="paymentOption('stripe')" :class="(method === 'stripe') ? 'border-green-600' : ''">
                                        <span class="text-sm ml-8 font-semibold text-custom-light-black">Stripe</span>
                                        <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'stripe') ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                        <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'stripe') ? 'block':'hidden' " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="18 15 12 9 6 15"></polyline>
                                        </svg>
                                    </div>
                                    <div class="mt-4" v-if="method === 'stripe'">
                                        <div class="ml-3">
                                            <input type="hidden" name="_type" value="stripe">
                                            <div class="flex flex-col">
                                                <div id="card-element" class="mb-3">
                                                </div>
                                                <div id="card-errors" role="alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="method === 'paypal'" class="mb-3 mt-4">
                                        <input type="hidden" name="_type" value="paypal">
                                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                                        <div id="paypal-button"></div>
                                    </div>
                                    <div class="flex items-center mb-4 justify-between rounded w-full border px-4 py-3 border-gray-300 group hover:border-green-600 cursor-pointer" @click="paymentOption('braintree')" :class="(method === 'braintree') ? 'border-green-600' : ''">
                                        <span class="text-sm ml-8 font-semibold text-custom-light-black">Braintree</span>
                                        <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'braintree') ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                        <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'braintree') ? 'block':'hidden' " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="18 15 12 9 6 15"></polyline>
                                        </svg>
                                    </div>
                                    <div class="mt-4" v-if="method === 'braintree'">
                                        <input type="hidden" name="_type" value="braintree">
                                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                                        <div class="flex flex-col md:flex-row items-center">
                                            <div class="flex flex-col w-full">
                                                <label class="mb-2" for="cc_number">Credit Card</label>
                                                <div class="px-4 py-3 rounded-lg h-16" id="card-number">
                                                </div>
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <label class="mb-2" for="expiry">Expiry</label>
                                                <div class="px-4 py-3 rounded-lg h-16" id="expiration-date">
                                                </div>
                                            </div>
                                            <div class="flex flex-col w-full">
                                                <label class="mb-2" for="cvv">CVV</label>
                                                <div class="px-4 py-3 rounded-lg h-16" id="cvv">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="!$v.$error" class="flex justify-end">
                            <button type="submit" class="mt-3 ml-2 px-8 w-full md:w-auto py-4 hover:opacity-75 rounded-lg text-white font-bold text-lg bg-custom-light-orange " 
                                :class="(submitStatus) ? 'visible' : 'invisible'"
                                >
                                Pay Now
                            </button>
                        </div>
                    </form>

                    <!--Cart Details-->
                    <div class="flex flex-col w-full my-10 md:w-64  lg:w-500">
                        <div class="flex justify-between w-full px-3 ">
                            <h3 class="text-lg font-semibold text-custom-light-black">My Cart</h3>
                            <span class="rounded-full p-1 text-custom-red-darker">{{ updatedQty }}</span>
                        </div>
                        <div v-for="product in products" class="px-3 w-full flex flex-col justify-between mt-4">
                            <div class="flex flex-col md:flex-row justify-between md:items-center">
                                <img class="h-40 w-full md:w-40 rounded-lg object-cover object-center" :src="`/storage/${product.options.imageUrl}`" onerror="this.src='/img/placeholder.png'">
                                <div class="ml-3 flex-1 mt-3 md:mt-0 flex  flex-row md:flex-col">
                                    <h4>{{ product.name }}</h4>
                                    <h4>$ {{ product.price }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex flex-col  rounded-lg p-3 my-3 border border-gray-300">
                            <div class="w-full flex items-center justify-between">
                                <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">SubTotal</span>
                                <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ sub }}</span>
                            </div>
                            <div class="w-full flex items-center justify-between">
                                <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Discount</span>
                                <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ dis }}</span>
                            </div>
                            <div class="w-full flex items-center justify-between">
                                <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">SubTotal After Discount</span>
                                <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ (afterdis) ? afterdis : sub }}</span>
                            </div>
                            <div class="w-full flex items-center justify-between">
                                <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Tax</span>
                                <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ tax }}</span>
                            </div>
                            <div class="w-full flex items-center justify-between">
                                <span class="my-2 px-3 py-3 flex-1 bg-white text-bold text-lg text-black-600 rounded-lg mr-2">Grand Total</span>
                                <span class="my-2 px-3 py-3 flex-1 text-bold text-lg text-black-600 rounded-lg mr-2 text-right">$ {{ grand }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="flex flex-row justify-center items-center h-screen">
                <div class="flex flex-col justify-center items-center border rounded shadow px-6 py-6">
                    <a :href="`/login`" class="w-full cursor-pointer text-center md:w-auto text-bold text-md md:mr-4 hover:opacity-75 text-custom-light-orange px-6 py-4 rounded-lg">Login Now</a>
                    <span @click="checkoutForm=true;" class="w-full mt-4 md:mt-0 cursor-pointer text-center md:w-auto text-bold text-md bg-custom-light-orange hover:opacity-75 text-white px-6 py-4 rounded-lg">Checkout as Guest</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Toast from '../helpers/Alert';
import { eventBus } from '../../app.js';
import swal from 'sweetalert';
import { required, minLength, maxValue, decimal,  between, email } from 'vuelidate/lib/validators';
export default {
    name: 'cart-checkout',
    props: ['auth', 'products', 'cart', 'sub', 'dis', 'afterdis', 'tax', 'grand', 'token'],
    data() {
        return {
            test : [1, 2,3 , 4,5,6,7,8,9,10],
            firstname: '',
            lastname: '',
            email: ' ',
            successCharge: false,
            checkoutForm: false,
            city: '',
            address: '',
            productsArr: [],
            updatedQty: this.cart,
            method: "",
            selected: null,
            status: false,
            message: null,
            err: null,
            otherProducts: [],
            stripeObj: null,
            stripeCard: null,
            braintreeInstance: null,
            loading: false,
            submitStatus : false,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    validations: {
        firstname: {
            required,
            minLength: minLength(3)
        },
        lastname: {
            required,
            minLength: minLength(3)
        },
        email: {
            required,
            email
        },
        city: {
            required
        },
        address: {
            required,
            minLength: minLength(3)
        }
    },
    mounted() {
        this.pushProducts();
        if(this.auth){
            this.checkoutForm = true;
            this.firstname    = this.auth.first_name;
            this.lastname     = this.auth.last_name;
            this.email        = this.auth.email;
        } 
    },
    methods: {
        pushProducts() {
            for (let [key, value] of Object.entries(this.products)) {
                this.productsArr.push(value);
            }
        },
        paymentOption(param) {
            this.method = param;
            let grand = this.grand;
            this.submitStatus = true;

            if (this.method === "stripe") {
                setTimeout(() => {
                    // Create a Stripe client.
                    // alert(process.env.MIX_STRIPE_APP_KEY);
                    let key = process.env.MIX_STRIPE_APP_KEY;
                    var stripe = Stripe(`${key}`);

                    // Create an instance of Elements.
                    var elements = stripe.elements();

                    // Custom styling can be passed to options when creating an Element.
                    // (Note that this demo uses a wider set of styles than the guide below.)
                    var style = {
                        base: {
                            color: '#32325d',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    };

                    // Create an instance of the card Element.
                    var card = elements.create('card', { style: style });

                    // Add an instance of the card Element into the `card-element` <div>.
                    card.mount('#card-element');

                    // Handle real-time validation errors from the card Element.
                    card.addEventListener('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    let component = this;
                    component.submitStatus = true;
                    this.stripeObj = stripe;
                    this.stripeCard = card;
                    document.getElementById('payment-form').addEventListener('submit', (e) => {
                        e.preventDefault();

                        stripe.createToken(card).then((result) => {
                            if (result.error) {
                                // Inform the user if there was an error.
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                eventBus.$emit('token-received', );
                                component.charge(result.token.id);
                                // component.charge('jjjjj');

                                // data.append('secret_token', result.token.id);
                                // Send the token to your server.
                                // stripeTokenHandler(result.token);
                                // this.submitPayment(result.token.id);
                            }
                        });
                    });

                }, 300);

            } else if (this.method === 'braintree') {
                let component = this;
                braintree.client.create({
                    authorization: `${this.token}`
                }, function(clientErr, clientInstance) {
                    if (clientErr) {
                        Toast.fire({
                            icon: 'error',
                            title: `${clientErr}`
                        });
                        console.error(clientErr);
                        return;
                    }
                    // This example shows Hosted Fields, but you can also use this
                    // client instance to create additional components here, such as
                    // PayPal or Data Collector.
                    braintree.hostedFields.create({
                        client: clientInstance,
                        styles: {
                            'input': {
                                'font-size': '14px',
                                'border': '2px solid gray'
                            },
                            'input.invalid': {
                                'color': 'red'
                            },
                            'input.valid': {
                                'color': 'green'
                            }
                        },
                        fields: {
                            number: {
                                selector: '#card-number',
                                placeholder: '4111 1111 1111 1111'
                            },
                            cvv: {
                                selector: '#cvv',
                                placeholder: '123'
                            },
                            expirationDate: {
                                selector: '#expiration-date',
                                placeholder: '10/2019'
                            }
                        }
                    }, function(hostedFieldsErr, hostedFieldsInstance) {
                        if (hostedFieldsErr) {

                            Toast.fire({
                                icon: 'error',
                                title: `There was some error. Please try again later.`
                            });
                        }


                        component.submitStatus = true;
                        document.getElementById('payment-form').addEventListener('submit', (e) => {
                            e.preventDefault();
                            hostedFieldsInstance.tokenize(function(tokenizeErr, payload) {
                                if (tokenizeErr) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: `Server error.`
                                    });
                                }


                                component.charge(payload.nonce);
                            });

                        });


                    });
                });

            }

        },
        charge(token) {
            console.log(token);
            this.loading = true;



            this.$v.$touch()
            if (this.$v.$error) {
                this.loading = false;
                swal({     
                    title: `Error!`,
                    text:   `Please fill form correctly!`,
                    icon: "error",
                    button: "Close",
                });
            } else {

                let data = new FormData();

                data.append('firstname', this.firstname);
                data.append('lastname', this.lastname);
                data.append('email', this.email);
                data.append('city', this.city);
                data.append('address', this.address);
                let paymentMethod = this.method;
                data.append('method', paymentMethod);
                data.append('secret_token', token);
                //Post
                axios.post('/charge', data)
                .then(res => {

                    if (res.status === 201) {
                        this.successCharge = true;
                        swal({
                            title: "Horray!",
                            text: "Your checkout is successful.Invoice has been sent to your email.",
                            icon: "success",
                            button: "Close",
                        });

                        this.loading = false;
                        this.firstname = '';
                        this.lastname = '';
                        this.email = '';
                        this.city = '';
                        this.address = '';
                        this.method = '';

                        axios.get(`/aftercheckout`)
                            .then(res => {
                                if (res.status === 200) {
                                    this.successCharge = true;
                                    this.otherProducts = res.data.products;
                                }
                            }).catch(err => {

                            });

                    } else {
                        swal({
                            title: "Error!",
                            text: "Your checkout wasn't successful. Please try again.",
                            icon: "error",
                            button: "Close",
                        });
                    }
                }).catch(err => {
                    this.loading = false;

                    let errors = err.response.data.errors;
                    if (errors) {

                        if (errors.firstname) {
                            errors.firstname.forEach((err) => {
                                swal({
                                    title: `Error!`,
                                    text:   `${err}`,
                                    icon: "error",
                                    button: "Close",
                                });
                            });
                        }

                        if (errors.lastname) {
                            errors.lastname.forEach((err) => {
                                swal({
                                    title: `Error!`,
                                    text:   `${err}`,
                                    icon: "error",
                                    button: "Close",
                                });
                            });
                        }

                        if (errors.email) {
                            this.emailErr = errors.email;
                        }

                        if (errors.city) {
                            this.cityErr = errors.city;
                        }

                        if (errors.address) {
                            this.addressErr = errors.address;
                        }

                        if (errors.secret_token) {
                            this.tokenErr = errors.secret_token;
                        }



                    }
                });
            }
        },
        removeMessage() {
            setTimeout(() => {
                this.message = null;
                this.err = null;
            }, 3000);
        }
    }
};

</script>
<style>
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
