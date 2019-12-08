<template>
    <div class="px-3 md:px-6 lg:px-12 z-10 py-3 md:py-8 ">
        <p v-if="message" :class="(status) ? 'bg-green-500' : 'bg-red-500' " class="rounded-lg text-md font-medium  text-white">
            {{ message }}
        </p>
        
        <div class="flex flex-row items-center my-6 mx-3  ">
            <div @click="paymentOption('stripe')" class="flex items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'stripe') ? 'border-green-600' : ''">
                <input  type="checkbox"  class="" v-model="method" >
                <span class="text-lg ml-8 font-bold text-black" >Stripe</span>
            </div>
            <div @click="paymentOption('paypal')" class="flex items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'paypal') ? 'border-green-600' : ''">
                <input  type="checkbox" class=""  v-model="method">
                <span class="text-lg ml-8 font-bold text-black" >Paypal</span>
            </div>
        </div>
        <div class="">
            <form v-if="method === 'stripe'" :action="`/charge`" :method="`post`" id="payment-form">
                <div class="ml-3">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_type" value="stripe">
                    <div class="flex flex-col">
                        <label for="card-element" class="mb-4 py-2 px-2 font-bold text-lg">
                          Credit details
                        </label>
                        <div id="card-element" class="mb-3">
                          <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <button class="px-6 py-4 hover:bg-green-500 rounded-full text-white font-bold text-lg bg-green-600">Submit Payment</button>
                </div>
            </form>
        </div>
        
    </div>
</template>

<script>
import KhaltiCheckout from "khalti-web";

    export default {
        name : 'cart-checkout',
        props : ['products', 'cart', 'sub', 'grand'],
        data(){
        	return {
                productsArr : [],
                updatedQty : this.cart,
                subTotal : this.sub,
                method : "",
                selected : null,
                grandTotal : this.grand,
                message   : null,
                err       : null,
                csrf : document.head.querySelector('meta[name="csrf-token"]').content
        	}
        },
        mounted() {
            this.pushProducts();

        },
        methods: {
            async pushProducts(){
                for (let [key, value] of Object.entries(this.products)) {
                    this.productsArr.push(value);
                }
            }, 
            async paymentOption(param){
                this.method = param;
                if(this.method === "stripe"){
                    setTimeout(() => {
                         // Create a Stripe client.
                        // alert(process.env.MIX_STRIPE_APP_KEY);
                        let key = process.env.MIX_STRIPE_APP_KEY;
                        var stripe = Stripe(key);

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
                        var card = elements.create('card', {style: style});

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

                          stripe.createToken(card).then(function(result) {
                            if (result.error) {
                              // Inform the user if there was an error.
                              var errorElement = document.getElementById('card-errors');
                              errorElement.textContent = result.error.message;
                            } else {
                              // Send the token to your server.
                              stripeTokenHandler(result.token);
                            }
                          });
                        });

                        // Submit the form with the token ID.
                        function stripeTokenHandler(token) {
                          // Insert the token ID into the form so it gets submitted to the server
                          var form = document.getElementById('payment-form');
                          var hiddenInput = document.createElement('input');
                          hiddenInput.setAttribute('type', 'hidden');
                          hiddenInput.setAttribute('name', 'stripeToken');
                          hiddenInput.setAttribute('value', token.id);
                          form.appendChild(hiddenInput);

                          // Submit the form
                          // alert(token);
                          form.submit();
                        }
                    }, 300);
                   
                } else if(this.method === "paypal"){

                }
            },
            async payment(){
                let config = {
                // replace this key with yours
                    "publicKey": process.env.MIX_KHALTI_PUBLIC_KEY,
                    "productIdentity": "1234567890",
                    "productName": "Drogon",
                    "productUrl": "http://gameofthrones.com/buy/Dragons",
                    "eventHandler": {
                        onSuccess (payload) {
                            // hit merchant api for initiating verfication
                            // console.log(payload);
                            axios.post(`/checkout-server`, {
                                payload : payload
                            }).then(res => {
                                console.log(res.data.response);
                            }).catch(err => {
                                this.status = false;
                                this.err = 'There was some error. Please try again.';
                                this.removeMessage();
                            });
                        },
                        // onError handler is optional
                        onError (error) {
                            // handle errors
                            console.log(error);
                        },
                        onClose () {
                            console.log('widget is closing');
                        }
                    }
                };

                // console.log(config);
                let checkout = new KhaltiCheckout(config);
                checkout.show({amount: 1000});
                            
            },
            async selectedMethod(){

            },
            async removeMessage(){
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
