<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Order;
use App\Order_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class CheckoutController extends Controller
{

    public function index(){


        if(Cart::count() < 1){
            return redirect('/shoes');
        }

        $token = 'sdkflsakdf';

    	$products = Cart::content();
		$totalQuantity = Cart::instance('default')->count();
		$subTotal = Cart::subtotal();
        $discount = (session('discount'))?? 0;
        $subAfterDis = (session('subAfterDis'))?? 0;
        $tax = Cart::tax();
		$grandTotal = (session('discount'))? session('grand') : Cart::total();
        $token = "someRandomCLientTOken";
		return view('home.checkout', compact('products', 'totalQuantity', 'subTotal', 'discount', 'subAfterDis', 'tax', 'grandTotal', 'token'));
    }


    /**
        * Successful Payment
        * Use Guzzle to send post request to khalti server for server verification
        * Return json RESPONSE
    */
    public function charge(Request $request){

        // dd($request->all());
        $data = $request->validate([
                'firstname' => 'required|string',
                'lastname'  => 'required|string',
                'email'     => 'required|email',
                'city'      => 'required|string',
                'address'   => 'required|string',
                'method'    => 'required|string',
                // 'secret_token'     => 'required|string'
        ]);
        
        //JUst For Testing
        // return response()->json(['success' => 'ok'], 201);

        
        $amt          = (session('discount'))? session('grand') : Cart::total();
        // dd($paymentType);
        if($data['method'] === 'braintree' || $data['method'] === 'paypal'){
                $gateway = new \Braintree\Gateway([
                    'environment' => config('services.braintree.environment'),
                    'merchantId' => config('services.braintree.merchantId'),
                    'publicKey' => config('services.braintree.publicKey'),
                    'privateKey' => config('services.braintree.privateKey')
                ]);
                $result = $gateway->transaction()->sale([
                    'amount'             => $amt,
                    'paymentMethodNonce' => request()->secret_token,
                    'customer'           => [
                        'firstName' => $data['firstname'],
                        'lastName'  => $data['lastname'],
                        'email'     => $data['email']
                    ],
                    'options' => [
                        'submitForSettlement' => true
                    ]
                ]);
                if ($result->success) {
                    $transaction = $result->transaction;
                    $this->store($data['firstname'], $data['lastname'], $data['email'], $data['city'], $data['address'], $data['method'], $transaction->id);
                    return response()->json(['success' => 'ok'], 201);
                } else {
                    $errorString = "";
                    foreach ($result->errors->deepAll() as $error) {
                        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                    }
                    return response()->json(['success' => '', 'error' => 'ok'], 503);
                }

            
        }  elseif($data['method'] === 'stripe') {
            try {
                // dd($paymentType);
                $gateway   = Omnipay::create('Stripe');               
                $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
                            
                $response  = $gateway->purchase([
                    'amount'   => $amt,
                    'currency' => 'usd',
                    'token'    => request()->secret_token,
                ])->send();
                
                // dd($response);
                if ($response->isSuccessful()) {
                    $transaction = Str::random(10);
                    $this->store($data['firstname'], $data['lastname'], $data['email'], $data['city'], $data['address'], $data['method'], $transaction);
                    return response()->json(['success' => 'ok'], 201);
                }
               
                
            } catch (CardErrorException $e) {
                return response()->json(['success' => '', 'error' => 'ok'], 503);

                return back()->with('error', $e->getMessage());
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
        $grandTotal = (session('discount')) ?  session('grand') :  Cart::total();
        $Authenticated = ($this->guard()) ? $this->guard()->id : null;
        
        $customerArray = ['customer_id'  => $Authenticated];

        $order = Order::create(array_merge([
            'first_name'   => $firstName,
            'last_name'    => $lastName, 
            'email'        => $email,
            'city'         => $city, 
            'street_address' => $address, 
            'phoneNumber'    => 9838383838,
            'payment_method' => $paymentType, 
            'payment_id'    => $paymentId, 
            'subtotal'      => $subTotal, 
            'discount'      => $discount, 
            'subafterdiscount' => $subAfterDis, 
            'tax'         => $tax, 
            'grand'      => $grandTotal
        ]), $customerArray ?? []);

        foreach(Cart::content() as $product){
            Order_Item::create(array_merge([
                'customer_id' => $Authenticated,  
                'order_id'    => $order->id,  
                'product_id' => $product->id,  
                'name'     => $product->name, 
                'price'    => $product->price, 
                'quantity' => $product->qty
            ]), $customerArray?? []);

            // $db_product = Product::findOrfail($product->id)->decrement('qty');
            // $db_product->qty = ($db_product->qty - $product->qty);
            // $db_product->save();
        }

        // Cart::destroy();
        // session()->forget('percent');
        // session()->forget('discount');
        // session()->forget('subAfterDis');
        // session()->forget('grand');
        // return true;
    }

    public function sellmoreProduct(){
        $products = Product::latest()->paginate(10);
        return response()->json(['success' => 'ok', 'products' => $products->items()], 200);
    }

    /**Get Braintree PUBLIC TOKEN **/
    public function getToken(){
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        return response()->json([
         'token' => $gateway->ClientToken()->generate()
        ]);
    }

    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }


}
