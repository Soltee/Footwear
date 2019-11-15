<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth:customer');
    }

    public function checkout(){
    	$products = Cart::session($this->guard()->id)->getContent();
		$totalQuantity = Cart::session($this->guard()->id)->getTotalQuantity();
		$subTotal = (Cart::session($this->guard()->id)->getSubTotal()) ?? false;
		$grandTotal = (Cart::session($this->guard()->id)->getTotal()) ?? false;
		// dd($products);
		return view('home.checkout', compact('products', 'totalQuantity', 'subTotal', 'grandTotal'));
    }


    /**
        * Successful Payment
        * Use Guzzle to send post request to khalti server for server verification
        * Return json RESPONSE
    */
    public function payment(Request $request){

        $request->validate([
            'token' => 'required|string',
            'amount' => 'required|integer',
            'idx' => 'required'
        ]);
        $headers = ['Authorization: Key ' . env('KHALTI_SECRET_KEY')];
        $url = "https://khalti.com/api/v2/payment/verify/";
   
        try {
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
        

        
    }

    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }


}
