<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Orders;
use App\Order_Items;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

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
        // dd($paymentType);
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
                    $this->store($firstName, $lastName, $email, $city, $address, $paymentType, $transaction);
                    return redirect()->route('thank-you');
                } else {
                    $errorString = "";
                    foreach ($result->errors->deepAll() as $error) {
                        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                    }
                    return back()->with('error', 'An error occurred with the message: '.$result->message);
                }

            
        }  elseif($paymentType === 'stripe') {
            try {
                // dd($paymentType);
                $gateway = Omnipay::create('Stripe');               
                $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
              
                $token = $request->input('stripeToken');
              
                $response = $gateway->purchase([
                    'amount' => $amt,
                    'currency' => 'usd',
                    'token' => request()->stripeToken,
                ])->send();
                
                // dd($response);
                if ($response->isSuccessful()) {
                    $transaction = Str::random(10);
                    $this->store($firstName, $lastName, $email, $city, $address, $paymentType, $transaction);
                    return redirect()->route('thank-you');
                }
               
                
            } catch (CardErrorException $e) {
                return back()->with('error', $e->getMessage());
            }
        }  elseif($paymentType === 'khalti') {
            $args = http_build_query(array(
                'token' => request()->khalti_token,
                'amount'  => $amt * 100
            ));

            $url = "https://khalti.com/api/v2/payment/verify/";

            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $headers = ['Authorization: Key '. env('KHALTI_SECRET_KEY') . ''];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Response
            $response = json_decode(curl_exec($ch));

            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($status_code === 200) {
                $transaction = Str::random(10);
                $this->store($firstName, $lastName, $email, $city, $address, $paymentType, $transaction);
                return redirect()->route('thank-you');
            } else {
                return back()->with('error', 'An error occurred Please try again. ');
            }
        }
        
    }

    /**
        * After Successful payment, store data to database
    **/
    public function store($firstName, $lastName,  $email, $city, $address, $paymentType, $paymentId){
        $products = Cart::content();
        $totalQuantity = Cart::instance('default')->count();
        $subTotal = Cart::subtotal();
        $discount = (session('discount'))?? 0;
        $subAfterDis = (session('subAfterDis'))?? 0;
        $tax = Cart::tax();
        $grandTotal = (session('discount'))? session('grand') : Cart::total();
        $Authenticated = ($this->guard()) ? $this->guard()->id : null;
        
        $order = Orders::create([
            'customer_id' => $Authenticated,
            'first_name' => $firstName,
            'last_name' => $lastName, 
            'email' => $email,
            'city' => $city, 
            'street_address' => $address, 
            'phoneNumber' => 9838383838,
            'payment_method' => $paymentType, 
            'payment_id' => $paymentId, 
            'subtotal' => $subTotal, 
            'discount' => $discount, 
            'subafterdiscount' => $subAfterDis, 
            'tax' => $tax, 
            'grand' => $grandTotal
        ]);

        foreach(Cart::content() as $product){
            Order_Items::create([
                'customer_id' => $Authenticated,  
                'orders_id' => $order->id,  
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
