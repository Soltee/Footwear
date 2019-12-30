<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use App\Orders;
use App\Order_Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{

    public function checkout(){

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);


    	$products = Cart::content();
		$totalQuantity = Cart::instance('default')->count();
		$subTotal = Cart::subtotal();
        $discount = (session('discount'))?? 0;
        $subAfterDis = (session('subAfterDis'))?? 0;
        $tax = Cart::tax();
		$grandTotal = (session('discount'))? session('grand') : Cart::total();
        $token = $gateway->ClientToken()->generate();
		return view('home.checkout', compact('products', 'totalQuantity', 'subTotal', 'discount', 'subAfterDis', 'tax', 'grandTotal', 'token'));
    }


    /**
        * Successful Payment
        * Use Guzzle to send post request to khalti server for server verification
        * Return json RESPONSE
    */
    public function charge(Request $request){

        $firstName = request()->firstname;
        $lastName = request()->lastname;
        $email = request()->email;
        $city = request()->city;
        $address = request()->address;
        $paymentType = request()->_type;
        $amt = (session('discount'))? session('grand') : Cart::total();

        if($paymentType === 'braintree' || $paymentType === 'paypal'){
                $gateway = new \Braintree\Gateway([
                    'environment' => config('services.braintree.environment'),
                    'merchantId' => config('services.braintree.merchantId'),
                    'publicKey' => config('services.braintree.publicKey'),
                    'privateKey' => config('services.braintree.privateKey')
                ]);
                $amount = $request->amount;
                $nonce = $request->payment_method_nonce;
                $result = $gateway->transaction()->sale([
                    'amount' => $amt,
                    'paymentMethodNonce' => $nonce,
                    'customer' => [
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email,
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ]
                ]);
                if ($result->success) {
                    $transaction = $result->transaction;
                    $this->store($firstName, $lastName, $email, $city, $address, $paymentType);
                    return redirect()->route('thank-you');
                } else {
                    $errorString = "";
                    foreach ($result->errors->deepAll() as $error) {
                        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                    }
                    return back()->with('error', 'An error occurred with the message: '.$result->message);
                }

            
        }  else {
            try {
                $stripe = Stripe::charges()->create([
                    'amount' => $amt,
                    'currency' => 'USD',
                    'source' => request()->stripeToken,
                    'description' => 'Testin',
                    'receipt_email' => 'larael_shop@shop.com',
                    'metadata' => [
                        'helo'=> 'helo'
                    ]
                ]);
                $this->store($firstName, $lastName,  $email, $city, $address, $paymentType);
                return redirect()->route('thank-you');
            } catch (CardErrorException $e) {
                return back()->with('error', $e->getMessage());
            }
        }        

        
    }

    /**
        * After Successful payment, store data to database
    **/
    public function store($firstName, $lastName,  $email, $city, $address, $paymentType){
        $products = Cart::content();
        $totalQuantity = Cart::instance('default')->count();
        $subTotal = Cart::subtotal();
        $discount = (session('discount'))?? 0;
        $subAfterDis = (session('subAfterDis'))?? 0;
        $tax = Cart::tax();
        $grandTotal = (session('discount'))? session('grand') : Cart::total();
        $Authenticated = ($this->guard()) ? $this->guard()->id : null;
        
        $order = Orders::create([
            'user_id' => $Authenticated,
            'first_name' => $firstName,
            'last_name' => $lastName, 
            'email' => $email,
            'city' => $city, 
            'street_address' => $address, 
            'phoneNumber' => 9838383838,
            'payment_method' => $paymentType, 
            'subtotal' => $subTotal, 
            'discount' => $discount, 
            'subafterdiscount' => $subAfterDis, 
            'tax' => $tax, 
            'grand' => $grandTotal
        ]);

        foreach(Cart::content() as $product){
            Order_Items::create([
                'order_id' => $Authenticated,  
                'order_id' => $order->id,  
                'name'     => $product->name, 
                'price'    => $product->price, 
                'quantity' => $product->qty
            ]);
        }
        Cart::destroy();
        session()->forget('discount');
        session()->forget('subAfterDis');
        session()->forget('grand');
        return true;
    }

    public function thankyou(){
        return view('home.thankyou');
    }
    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }


}
