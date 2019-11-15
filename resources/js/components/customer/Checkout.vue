<template>
    <div class="container ">
        <p v-if="message" :class="(status) ? 'bg-green-500' : 'bg-red-500' " class="rounded-lg text-md font-medium  text-white">
            {{ message }}
        </p>
        
        <div>
            <button @click="payment()" class="p-3 text-lg text-white bg-green-800">Khalti Payment</button>
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
                grandTotal : this.grand,
                message   : null,
                err       : null
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
                            console.log(payload);
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

                console.log(config);
                let checkout = new KhaltiCheckout(config);
                checkout.show({amount: 1000});
                            
            },
            async removeMessage(){
                setTimeout(() => {
                    this.message = null;
                    this.err = null;
                }, 3000);
            }
        }
    }
</script>
<style scoped>
    
</style>
