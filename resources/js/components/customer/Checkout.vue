<template>
    <div class="z-0 w-full my-8">
        <div v-if="showField" class="w-full">
            <div class="flex items-center px-2">
                <div class="flex items-center">
                    <a :href="`/shoes`" class=" text-md  opacity-75">Back to Shop</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-800 mx-2">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                    <a :href="`/cart-details`" class="  text-md  text-custom-light-black opacity-75">Cart</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-gray-700 mx-2">
                        <polyline points="13 17 18 12 13 7"></polyline>
                        <polyline points="6 17 11 12 6 7"></polyline>
                    </svg>
                    <h4 class="font-semibold text-md  text-custom-light-black ">Checkout</h4>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between my-8 w-full">
                <form id="payment-form">
                    <div class="flex-1">
                        <!-- <input type="hidden" name="_token" :value="csrf"> -->
                        <!-- <input name="amount" type="hidden" :value="grand" /> -->
                        <div class="w-full mb-6  border border-gray-300 p-3">
                            <h3 class="text-lg font-semibold text-custom-light-black mb-6 px-2 ">Personal Info</h3>
                            <div class="mb-4  w-full px-2 ">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                                    First Name
                                </label>
                                <input class="hadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" type="text" placeholder="Roman" v-model="firstname">
                            </div>
                            <div class="mb-4 w-full px-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                                    Last Name
                                </label>
                                <input class="hadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" placeholder="Dide" v-model="lastname">
                            </div>
                            <div class="w-full mb-6 px-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" v-model="email" type="email" placeholder="email">
                            </div>
                            <div class="w-full flex flex-wrap -mx-3 mb-6 px-2">
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                                        City
                                    </label>
                                    <div class="relative">
                                        <select class="block appearance-none w-full  border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" v-model="city">
                                            <option>Pokhara</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street">
                                        Street Address
                                    </label>
                                    <div class="relative">
                                        <input class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="street" type="text" placeholder="Albuquerque" v-model="address">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full mb-6  border border-gray-300 p-3">
                            <h3 class="text-lg font-semibold text-custom-light-black mb-6 w-full px-2">Payment Method</h3>
                            <div class="flex items-center mb-4 justify-between rounded w-full border px-4 py-3 border-gray-300 group hover:border-green-600 cursor-pointer" @click="paymentOption('stripe')" :class="(method === 'stripe') ? 'border-green-600' : ''">
                                <span class="text-lg ml-8 font-bold text-custom-light-black">Stripe</span>
                                <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'stripe') ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                                <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'stripe') ? 'block':'hidden' " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg>
                            </div>
                            <div class="flex items-center mb-4 justify-between rounded w-full border px-4 py-3 border-gray-300 group hover:border-green-600 cursor-pointer" @click="paymentOption('braintree')" :class="(method === 'braintree') ? 'border-green-600' : ''">
                                <span class="text-lg ml-8 font-bold text-custom-light-black">Braintree</span>
                                <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'braintree') ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                                <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'braintree') ? 'block':'hidden' " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg>
                            </div>
                            <div class="flex items-center mb-4 justify-between rounded w-full border px-4 py-3 border-gray-300 group hover:border-green-600 cursor-pointer" @click="paymentOption('paypal')" :class="(method === 'paypal') ? 'border-green-600' : ''">
                                <span class="text-lg ml-8 font-bold text-custom-light-black">Paypal</span>
                                <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'paypal') ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                                <svg class="w-8 h-8 mr-2 text-custom-light-black" :class="(method === 'paypal') ? 'block':'hidden' " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
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
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="mt-3 ml-2 px-8 w-full md:w-auto py-4 hover:opacity-75 rounded-lg text-white font-bold text-lg bg-custom-light-orange ">Pay Now</button>
                    </div>
                </form>
                <!--Cart Details-->
                <div class="flex flex-col w-full my-10 md:w-64  lg:w-500">
                    <div class="flex justify-between w-full px-3 ">
                        <h3 class="text-lg font-bold text-custom-light-black">My Cart</h3>
                        <span class="rounded-full p-1 text-custom-red-darker">{{ updatedQty }}</span>
                    </div>
                    <div v-for="product in products" class="px-3 w-full flex flex-col justify-between mt-4">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <img class="h-40 w-full md:w-40 rounded-lg object-cover object-center" :src="`/storage/${product.options.imageUrl}`">
                            <div class="ml-3 flex-1 flex flex-col">
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
            <div class="flex flex-col md:flex-row justify-center items-center border rounded shadow px-6 py-6">
                <a :href="`/login`" class="w-full cursor-pointer text-center md:w-auto text-bold text-md md:mr-4 hover:opacity-75 text-custom-light-orange px-6 py-4 rounded-lg">Login Now</a>
                <span @click="showField=true;" class="w-full mt-4 md:mt-0 cursor-pointer text-center md:w-auto text-bold text-md bg-custom-light-orange hover:opacity-75 text-white px-6 py-4 rounded-lg">Checkout as Guest</span>
            </div>
        </div>
    </div>
</template>
<script>
import Toast from '../helpers/Alert';
export default {
    name: 'cart-checkout',
    props: ['auth', 'products', 'cart', 'sub', 'dis', 'afterdis', 'tax', 'grand', 'token'],
    data() {
        return {
            firstname: '',
            lastname: '',
            email: ' ',
            showField: false,
            city: '',
            address: '',
            productsArr: [],
            updatedQty: this.cart,
            method: "",
            selected: null,
            status: false,
            message: null,
            err: null,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    mounted() {
        this.pushProducts();
        (auth) ? (this.showField = true) : (this.showField = false);
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
            const form = document.getElementById('payment-form');
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

                    // Handle form submission.
                    var form = document.getElementById('payment-form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        stripe.createToken(card).then((result) => {
                            if (result.error) {
                                // Inform the user if there was an error.
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                // Send the token to your server.
                                // stripeTokenHandler(result.token);
                                this.submitPayment(result.token.id);
                            }
                        });
                    });

                    // Submit the form with the token ID.
                    function stripeTokenHandler(token) {
                        // Insert the token ID into the form so it gets submitted to the server
                        // this.payNow(token.id);
                        // var form = document.getElementById('payment-form');
                        // var hiddenInput = document.createElement('input');
                        // hiddenInput.setAttribute('type', 'hidden');
                        // hiddenInput.setAttribute('name', 'stripeToken');
                        // hiddenInput.setAttribute('value', token.id);
                        // form.appendChild(hiddenInput);


                        // form.submit();
                    }
                }, 300);

            } else if (this.method === 'braintree') {

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
                            // this.status = false;
                            // this.message = "There was some error. Please try again later";
                            // this.removeMessage();
                            // return;
                            Toast.fire({
                                icon: 'error',
                                title: `There was some error. Please try again later.`
                            });
                        }
                        // submit.removeAttribute('disabled');
                        form.addEventListener('submit', function(event) {
                            event.preventDefault();
                            hostedFieldsInstance.tokenize(function(tokenizeErr, payload) {
                                if (tokenizeErr) {
                                    Toast.fire({
                                        icon: 'error',
                                        title: `Server error.`
                                    });
                                    // this.status = false;
                                    // this.message = "There was some error. Please try again later";
                                    // this.removeMessage();
                                    // return;
                                }
                                this.submitPayment(payload.nounce);
                                // If this was a real integration, this is where you would
                                // send the nonce to your server.
                                // console.log('Got a nonce: ' + payload.nonce);
                                // document.querySelector('#nonce').value = payload.nonce;
                                // form.submit();
                            });
                        }, false);
                    });
                });

            } else if (this.method === 'khalti') {
                let key = process.env.MIX_KHALTI_APP_KEY;
                var config = {
                    // replace the publicKey with yours
                    "publicKey": `${key}`,
                    "productIdentity": "1234567890",
                    "productName": "Dragon",
                    "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                    "eventHandler": {
                        onSuccess(payload) {
                            // hit merchant api for initiating verfication
                            console.log(payload);
                            var hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'khalti_token');
                            hiddenInput.setAttribute('value', payload.token);
                            form.appendChild(hiddenInput);


                            form.submit();
                        },
                        onError(error) {
                            console.log(error);
                        },
                        onClose() {
                            console.log('widget is closing');
                        }
                    }
                };

                var checkout = new KhaltiCheckout(config);
                checkout.show({ amount: this.grand * 100 });

            } else if (this.method === 'paypal') {

                braintree.client.create({
                    authorization: `${this.token}`
                }, function(clientErr, clientInstance) {
                    if (clientErr) {
                        Toast.fire({
                            icon: 'error',
                            title: `${clientErr}.`
                        });
                        console.error(clientErr);
                        return;
                    }
                    // Create a PayPal Checkout component.
                    braintree.paypalCheckout.create({
                        client: clientInstance
                    }, function(paypalCheckoutErr, paypalCheckoutInstance) {
                        // Stop if there was a problem creating PayPal Checkout.
                        // This could happen if there was a network error or if it's incorrectly
                        // configured.
                        if (paypalCheckoutErr) {
                            console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
                            Toast.fire({
                                icon: 'error',
                                title: `${paypalCheckoutErr}.`
                            });
                            return;
                        }
                        // Set up PayPal with the checkout.js library
                        paypal.Button.render({
                            env: 'sandbox', // or 'production'
                            commit: true,
                            payment: function() {
                                return paypalCheckoutInstance.createPayment({
                                    // Your PayPal options here. For available options, see
                                    // http://braintree.github.io/braintree-web/current/PayPalCheckout.html#createPayment
                                    flow: 'checkout', // Required
                                    amount: grand, // Required
                                    currency: 'USD', // Required
                                });
                            },
                            onAuthorize: function(data, actions) {
                                return paypalCheckoutInstance.tokenizePayment(data, function(err, payload) {
                                    // Submit `payload.nonce` to your server.

                                    // document.querySelector('#nonce').value = payload.nonce;
                                    // form.submit();
                                });
                            },
                            onCancel: function(data) {
                                this.status = false;
                                this.message = 'Your payment was cancelled.';
                                this.removeMessage();
                                console.log();
                            },
                            onError: function(err) {
                                this.status = false;
                                this.message = "There was some error. Please try again later";
                                this.removeMessage();
                            }
                        }, '#paypal-button').then(function() {
                            // The PayPal button will be rendered in an html element with the id
                            // `paypal-button`. This function will be called when the PayPal button
                            // is set up and ready to be used.
                        });
                    });
                });
            }
        },
        submitPayment(token) {
            let data = new FormData();

            data.append('firstname', this.firstname);
            data.append('lastname', this.lastname);
            data.append('email', this.email);
            data.append('city', this.city);
            data.append('address', this.address);
            data.append('method', this.method);
            data.append('token', token);

            axios.post('/charge', data)
                .then(res => {
                    if (res.status === 201) {


                    }
                }).catch(err => {
                    Toast.fire({
                        icon: 'error',
                        title: `Server error.`
                    });

                });
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
<style scoped>
</style>
