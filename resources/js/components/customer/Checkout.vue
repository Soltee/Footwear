<template>
    <div class="z-0  px-3  md:px-16   w-full">
        <div class="flex items-center">
            <a :href="`/shoes`" class="font-bold text-lg text-indigo-900 flex items-center">
              <svg  class="h-6 w-6 text-gray-700 mx-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/></svg>
            </a>
            <h4 class="font-bold text-lg text-gray-900 opacity-75">Checkout</h4>
        </div>
          
        <div class="flex flex-col md:flex-row justify-between my-8 w-full">
            <form :action="`/charge`" :method="`post`" id="payment-form">
              <div class="flex-1">
                
                <input type="hidden" name="_token" :value="csrf">
                <input name="amount" type="hidden" :value="grand" />

                <h3 class="text-lg font-semibold text-gray-900 mb-6 px-2 ">Fill Personal Info</h3>
                <div class="mb-4  w-full px-2 ">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                    First Name
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" name="firstname" type="text" :value="(auth) ? auth.first_name : ''" placeholder="firstname">
                </div>

                <div class="mb-4 w-full px-2">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                    Last Name
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" name="lastname" type="text" :value="(auth) ? auth.last_name : ''" placeholder="lastname">
                </div>

                <div class="w-full mb-6 px-2">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                  </label>
                  <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" :value="(auth) ? auth.email : ''" type="email" placeholder="email">
                </div>


                <div class="w-full flex flex-wrap -mx-3 mb-6 px-2">
                  <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                      City
                    </label>
                    <div class="relative">
                      <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-city" name="city">
                        <option>Pokhara</option>
                      </select>
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                    </div>
                  </div>
                  <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="street">
                      Street Address
                    </label>
                    <div class="relative">
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="street" type="text" placeholder="Albuquerque" name="address">


                    </div>
                  </div>
                </div>

                <h3 class="text-lg font-semibold text-gray-900 mb-6 w-full px-2">Select Payment Method</h3>

                <div class="w-full flex flex-col flex-wrap md:flex-row items-left my-6 mx-3  ">
                    <div @click="paymentOption('braintree')" class="flex w-auto mb-3 md:mb-0 items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'braintree') ? 'border-green-600' : ''">
                        <!-- <input  type="checkbox" class=""  v-model="method"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 hover:text-green-600 group-hover:text-green-600"  :class="(method == 'braintree') ? 'text-green-600' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span class="text-lg ml-8 font-bold text-gray-900" >Braintree</span>
                    </div>
                    <div @click="paymentOption('stripe')" class="flex w-auto mb-3 md:mb-0 items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'stripe') ? 'border-green-600' : ''">
                        <!-- <input  type="checkbox"  class="" v-model="method" > -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 hover:text-green-600 group-hover:text-green-600" :class="(method == 'stripe') ? 'text-green-600' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span class="text-lg ml-8 font-bold text-gray-900" >Stripe</span>
                    </div>
                    <div @click="paymentOption('paypal')" class="flex w-auto mb-3 md:mb-0 items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'paypal') ? 'border-green-600' : ''">
                        <!-- <input  type="checkbox"  class="" v-model="method" > -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 hover:text-green-600 group-hover:text-green-600" :class="(method == 'paypal') ? 'text-green-600' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span class="text-lg ml-8 font-bold text-gray-900" >Paypal</span>
                    </div>

                     <div @click="paymentOption('khalti')" class="flex w-auto mb-3 md:mb-0 items-center p-4 rounded-lg mr-12 border-2 border-gray-300 group hover:border-green-600 checkbox cursor-pointer" :class="(method === 'khalti') ? 'border-green-600' : ''">
                        <!-- <input  type="checkbox"  class="" v-model="method" > -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 hover:text-green-600 group-hover:text-green-600" :class="(method == 'khalti') ? 'text-green-600' : 'text-gray-900 '"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span class="text-lg ml-8 font-bold text-gray-900" >Khalti</span>
                    </div>

                </div>
                <div class="w-full" v-if="method === 'braintree'">
                    <input type="hidden" name="_type" value="braintree">
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <div class="flex flex-col md:flex-row items-center">

                        <div class="flex flex-col w-full">
                            <label class="mb-2" for="cc_number">Credit Card Number</label>

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
                <div v-if="method === 'paypal'" class="mb-3">
                    <input type="hidden" name="_type" value="paypal">
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <div id="paypal-button"></div> 
                </div>

                <div v-if="method === 'khalti'" class="mb-3">
                    <input type="hidden" name="_type" value="khalti">
                </div>

                <button type="submit" class="mt-5 ml-2 px-6 py-4 hover:bg-green-500 rounded-full text-white font-bold text-lg bg-green-800 ">Submit Payment</button>
              </div>
            </form>

            <!--Cart Details-->
            <div class="flex flex-col w-full my-10  md:w-64">
              <div class="flex justify-between w-full px-3 ">
                <h3 class="text-lg font-bold text-gray-900">My Cart</h3>
                <span class="rounded-full p-1 text-custom-red-darker">{{ updatedQty }}</span>
              </div>
              <div v-for="product in products" class="px-3 w-full flex flex-col justify-between mt-4">
                <div class="flex flex-row justify-between items-center">
                    <img class="h-16 w-16 rounded-lg object-cover object-center" :src="`/storage/${product.options.imageUrl}`">
                    <div class="ml-3 flex-1 flex flex-col">
                      <h4>{{ product.name }}</h4>
                      <h4>$ {{ product.price }}</h4>
                    </div>
                </div>
              </div>
              <div class="w-full flex flex-col  rounded-lg p-3 mb-3">
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
</template>

<script>

    export default {
        name : 'cart-checkout',
        props : ['auth', 'products', 'cart','sub', 'dis', 'afterdis', 'tax', 'grand', 'token'],
        data(){
        	return {
                productsArr : [],
                updatedQty : this.cart,
                method : "",
                selected : null,
                status : false,
                message   : null,
                err       : null,
                csrf : document.head.querySelector('meta[name="csrf-token"]').content
        	}
        },
        mounted() {
            this.pushProducts();
        },
        methods: {
            pushProducts(){
                for (let [key, value] of Object.entries(this.products)) {
                    this.productsArr.push(value);
                }
            }, 
            paymentOption(param){
                this.method = param;
                let grand = this.grand;
                const form = document.getElementById('payment-form');
                if(this.method === "stripe"){
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

                
                          form.submit();
                        }
                    }, 300);
                   
                }  else if(this.method === 'braintree'){
                    this.braintreePayment(form);
                }  else if(this.method === 'khalti'){
                  let key = process.env.MIX_KHALTI_APP_KEY;
                  var config = {
                      // replace the publicKey with yours
                      "publicKey": `${key}`,
                      "productIdentity": "1234567890",
                      "productName": "Dragon",
                      "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                      "eventHandler": {
                          onSuccess (payload) {
                              // hit merchant api for initiating verfication
                              console.log(payload);
                              var hiddenInput = document.createElement('input');
                              hiddenInput.setAttribute('type', 'hidden');
                              hiddenInput.setAttribute('name', 'khalti_token');
                              hiddenInput.setAttribute('value', payload.token);
                              form.appendChild(hiddenInput);

                    
                              form.submit();
                          },
                          onError (error) {
                              console.log(error);
                          },
                          onClose () {
                              console.log('widget is closing');
                          }
                      }
                  };

                  var checkout = new KhaltiCheckout(config);
                  checkout.show({amount: this.grand * 100});

                } else if(this.method === 'paypal') {

                      braintree.client.create({
                          authorization: `${this.token}`
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
                                amount: grand, // Required
                                currency: 'USD', // Required
                              });
                            },
                            onAuthorize: function (data, actions) {
                              return paypalCheckoutInstance.tokenizePayment(data, function (err, payload) {
                                // Submit `payload.nonce` to your server.
                                document.querySelector('#nonce').value = payload.nonce;
                                // form.submit();
                              });
                            },
                            onCancel: function (data) {
                              this.status = false;
                              this.message = 'Your payment was cancelled.';
                              this.removeMessage();
                              console.log();
                            },
                            onError: function (err) {
                              this.status = false;
                              this.message = "There was some error. Please try again later";
                              this.removeMessage();
                            }
                          }, '#paypal-button').then(function () {
                            // The PayPal button will be rendered in an html element with the id
                            // `paypal-button`. This function will be called when the PayPal button
                            // is set up and ready to be used.
                          });
                      });
                      });
                }
            },
            braintreePayment(form){
              braintree.client.create({
                  authorization: `${this.token}`
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
                      this.status = false;
                      this.message = "There was some error. Please try again later";
                      this.removeMessage();
                      return;
                    }
                    // submit.removeAttribute('disabled');
                    form.addEventListener('submit', function (event) {
                      event.preventDefault();
                      hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
                        if (tokenizeErr) {
                          this.status = false;
                          this.message = "There was some error. Please try again later";
                          this.removeMessage();
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
            },
            removeMessage(){
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
