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
		$grandTotal = ($this->guard()) ? (Cart::session($this->guard()->id)->getTotal()) : Cart::total();
		// dd($products);
		return view('home.checkout', compact('products', 'totalQuantity', 'subTotal', 'grandTotal'));
    }


    /**
        * Successful Payment
        * Use Guzzle to send post request to khalti server for server verification
        * Return json RESPONSE
    */
    public function charge(Request $request){

        // dd(request()->all());
        // $request->validate([
        //     'token' => 'required|string',
        //     'amount' => 'required|integer',
        //     'idx' => 'required'
        // ]);
        // $headers = ['Authorization: Key ' . env('KHALTI_SECRET_KEY')];
        // $url = "https://khalti.com/api/v2/payment/verify/";
        
        if(request()->_type === 'khalti'){
            // try {
            //     $client = new \GuzzleHttp\Client();
            //     $response = $client->post($url, [
            //         'headers' => $headers,
            //         'form_params' => [
            //             'token' => request('token'),
            //             'amount' => request('amount')
            //         ]
            //     ]);

            //     return response()->json(['success' => 'ok', 'response' =>  $response->getBody()], 201);
            // }
            // catch (Exception $e) {
            //     return response()->json([], 404);
            // }
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
