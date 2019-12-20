<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{

    public function checkout(){
    	$products = Cart::content();
		$totalQuantity = Cart::instance('default')->count();
		$subTotal = Cart::subtotal();
		$grandTotal = Cart::total();
		return view('home.checkout', compact('products', 'totalQuantity', 'subTotal', 'grandTotal'));
    }

    /*
        * Create Authorization Token for Braintree
    */
    public function braintreeToken()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        return response()->json(['token' => $gateway->ClientToken()->generate()], 200);
    }
    /**
        * Successful Payment
        * Use Guzzle to send post request to khalti server for server verification
        * Return json RESPONSE
    */
    public function charge(Request $request){

        // dd(request()->all());

        if(request()->_type === 'braintree'){
                $gateway = new \Braintree\Gateway([
                    'environment' => config('services.braintree.environment'),
                    'merchantId' => config('services.braintree.merchantId'),
                    'publicKey' => config('services.braintree.publicKey'),
                    'privateKey' => config('services.braintree.privateKey')
                ]);
                $amount = $request->amount;
                $nonce = $request->payment_method_nonce;
                $result = $gateway->transaction()->sale([
                    'amount' => $amount,
                    'paymentMethodNonce' => $nonce,
                    'customer' => [
                        'firstName' => 'Tony',
                        'lastName' => 'Stark',
                        'email' => 'tony@avengers.com',
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ]
                ]);
                if ($result->success) {
                    $transaction = $result->transaction;
                    return back()->with('success', 'Transaction successful. The ID is:'. $transaction->id);
                } else {
                    $errorString = "";
                    foreach ($result->errors->deepAll() as $error) {
                        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                    }
                    return back()->with('error', 'An error occurred with the message: '.$result->message);
                }

            
        } elseif(request()->_type === "khalti"){
            try {
            $headers = ['Authorization: Key ' . config('services.khalti.secretKey')];
            $url = "https://khalti.com/api/v2/payment/verify/";
                $client = new \GuzzleHttp\Client();
                $response = $client->post($url, [
                    'headers' => $headers,
                    'form_params' => [
                        'token' => request('token'),
                        'amount' => request('amount')
                    ]
                ]);

                return response()->json(['success' => 'ok', 'response' =>  $response->getBody()], 201);
            }
            catch (Exception $e) {
                return response()->json([], 404);
            }
        } else {
            try {
                $stripe = Stripe::charges()->create([
                    'amount' => 20,
                    'currency' => 'USD',
                    'source' => request()->stripeToken,
                    'description' => 'Testin',
                    'receipt_email' => 'larael_shop@shop.com',
                    'metadata' => [
                        'helo'=> 'helo'
                    ]
                ]);
                return back()->with('success', 'Your payment has been successful.');
            } catch (CardErrorException $e) {
                return back()->with('error', $e->getMessage());
            }
        }
        
        

        
    }

    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }


}
