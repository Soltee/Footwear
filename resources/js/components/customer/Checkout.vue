<template>
    <div class="px-3 md:px-6 lg:px-12 z-10 py-3 md:py-8 ">
        <p v-if="message" :class="(status) ? 'bg-green-500' : 'bg-red-500' " class="rounded-lg text-md font-medium  text-white">
            {{ message }}
        </p>

        <form :action="`/charge`" :method="`post`" id="payment-form">
            <input type="hidden" name="_token" :value="csrf">
            <input name="amount" type="hidden" :value="100" />

            <div class="flex flex-row items-center my-6 mx-3  ">
                <div @click="paymentOption('braintree')" class="flex items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'braintree') ? 'border-green-600' : ''">
                    <input  type="checkbox" class=""  v-model="method">
                    <span class="text-lg ml-8 font-bold text-black" >Braintree</span>
                </div>
                <div @click="paymentOption('stripe')" class="flex items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'stripe') ? 'border-green-600' : ''">
                    <input  type="checkbox"  class="" v-model="method" >
                    <span class="text-lg ml-8 font-bold text-black" >Stripe</span>
                </div>
                <div @click="paymentOption('paypal')" class="flex items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'paypal') ? 'border-green-600' : ''">
                    <input  type="checkbox"  class="" v-model="method" >
                    <span class="text-lg ml-8 font-bold text-black" >Paypal</span>
                </div>

            </div>
            <div v-if="method === 'braintree'">
                <input type="hidden" name="_type" value="braintree">
                <input id="nonce" name="payment_method_nonce" type="hidden" />

                <div class="flex flex-row items-center">

                    <div class="flex flex-col">
                        <label class="mb-2" for="cc_number">Credit Card Number</label>

                        <div class="form-group" id="card-number">

                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2" for="expiry">Expiry</label>

                        <div class="form-group" id="expiration-date">

                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="mb-2" for="cvv">CVV</label>

                        <div class="form-group" id="cvv">

                        </div>
                    </div>

                </div>

            </div>
            <div v-if="method === 'stripe'">
                <div class="ml-3">
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

                </div>
            </div>
            <div v-if="method === 'paypal'">
                <div id="paypal-button"></div>                
            </div>
            <button class="px-6 py-4 hover:bg-green-500 rounded-full text-white font-bold text-lg bg-green-600">Submit Payment</button>

        </form>
        
    </div>
</template>

<script>
import KhaltiCheckout from "khalti-web";

    export default {
        name : 'cart-checkout',
        props : ['products', 'cart','sub', 'grand'],
        data(){
        	return {
                productsArr : [],
                updatedQty : this.cart,
                method : "",
                selected : null,
                subTotal : this.sub,
                total : this.grand,
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
                const form = document.getElementById('payment-form');
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
                   
                }  else if(this.method === 'braintree'){
                    this.braintreePayment(form);
                } else if(this.method === 'paypal') {

                    axios.post('/braintree-token', {}).then((res) => {
                        if(res.status == 200){
                            braintree.client.create({
                                authorization: `${res.data.token}`
                            }, function (clientErr, clientInstance) {
                            if (clientErr) {
                              console.error(clientErr);
                              return;
                            }
                            // Create a PayPal Checkout component.
                            braintree.paypalCheckout.create({
                                    client: clientInstance
                                }, function (paypalCheckoutErr, paypalCheckoutInstance) {
                                // Stop if there was a problem creating PayPal Checkout.
                                // This could happen if there was a network error or if it's incorrectly
                                // configured.
                                if (paypalCheckoutErr) {
                                  console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
                                  return;
                                }
                                // Set up PayPal with the checkout.js library
                                paypal.Button.render({
                                  env: 'sandbox', // or 'production'
                                  commit: true,
                                  payment: function () {
                                    return paypalCheckoutInstance.createPayment({
                                      // Your PayPal options here. For available options, see
                                      // http://braintree.github.io/braintree-web/current/PayPalCheckout.html#createPayment
                                      flow: 'checkout', // Required
                                      amount: 13.00, // Required
                                      currency: 'USD', // Required
                                    });
                                  },
                                  onAuthorize: function (data, actions) {
                                    return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
                                      // Submit `payload.nonce` to your server.
                                      document.querySelector('#nonce').value = payload.nonce;
                                      form.submit();
                                    });
                                  },
                                  onCancel: function (data) {
                                    console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
                                  },
                                  onError: function (err) {
                                    console.error('checkout.js error', err);
                                  }
                                }, '#paypal-button').then(function () {
                                  // The PayPal button will be rendered in an html element with the id
                                  // `paypal-button`. This function will be called when the PayPal button
                                  // is set up and ready to be used.
                                });
                            });
                            });
                        }
                     }).catch(err => {
                        console.log(err);
                    }); 
                }
            },
            async braintreePayment(form){
                axios.post('/braintree-token', {}).then((res) => {
                    if(res.status == 200){
                        braintree.client.create({
                            authorization: `${res.data.token}`
                          }, function (clientErr, clientInstance) {
                            if (clientErr) {
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
                                  'font-size': '14px'
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
                            }, function (hostedFieldsErr, hostedFieldsInstance) {
                              if (hostedFieldsErr) {
                                console.error(hostedFieldsErr);
                                return;
                              }
                              // submit.removeAttribute('disabled');
                              form.addEventListener('submit', function (event) {
                                event.preventDefault();
                                hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                                  if (tokenizeErr) {
                                    console.error(tokenizeErr);
                                    return;
                                  }
                                  // If this was a real integration, this is where you would
                                  // send the nonce to your server.
                                  // console.log('Got a nonce: ' + payload.nonce);
                                  document.querySelector('#nonce').value = payload.nonce;
                                  form.submit();
                                });
                              }, false);
                            });
                        });
                    }
                }).catch(err => {
                    console.log(err);
                }); 
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
