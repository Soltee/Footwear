<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Product;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
	/**
	 	* Check if The Product is Already Added in the Cart
	 	* Used in Product.vue
	*/
	public function isProductAlreadyAdded($product){
		$product = Product::findOrFail($product);
		$added = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        });
		return response()->json(['isAdded' => ($added->isNotEmpty() ? true : false) ], 200);
	} 


	/**
	 	* Return @json
	 	   * Products added to the CART
	 	   * Total Quantity
	 	   * And Grand Total Cost
	 	* Used in Product.vue
	*/
	public function getCartProducts(){


		return response()->json([
			'cartProducts' => Cart::content(),
			'totalQty' => Cart::instance('default')->count() ,
			'grandTotal' => Cart::total(),

		], 200);
	
	}    

	/**
	 	* CART PAGE OF CUSTOMER
	 	* Return @view CART
	*/
	public function show(){
		// Cart::destroy();
        // session()->forget('percent');
        // session()->forget('discount');
        // session()->forget('subAfterDis');
        // session()->forget('grand');
		$products        = Cart::content();
		$totalQuantity   = 	Cart::instance('default')->count();
		$subTotal        = Cart::subtotal();
		$percent         = (session('percent'))?? 0;
		$discount        = (session('discount'))?? 0;
		$subAfterDis     = (session('subAfterDis'))?? 0;
		$tax             = Cart::tax();
		$grandTotal      = (session('discount'))? session('grand') : Cart::total();

		// foreach(Cart::content() as $product){

		// 	dd($product->id);
  //           Order_Items::create(array_merge([
  //               'customer_id' => $Authenticated,  
  //               'orders_id'   => $order->id,  
  //               'products_id' => $product->id,  
  //               'name'     => $product->name, 
  //               'price'    => $product->price, 
  //               'quantity' => $product->qty
  //           ]), $customerArray?? []);

  //           // $db_product = Product::findOrfail($product->rowId);
  //           // $db_product->qty = ($db_product->qty - $product->qty);
  //           // $db_product->save();
  //       }

		return view('home.cart', compact('products', 'totalQuantity', 'subTotal', 'discount', 'percent', 'subAfterDis', 'tax', 'grandTotal'));
	}

	/**
	 	* Get Cart Products according to Logged in User
	 	* Loops all the products, push to new array AND 
	 		returns the @ARRAY
	*/
	public function getContent(){
		$collection = ($this->guard()) ? Cart::session($this->guard()->id)->getContent() : Cart::getContent() ;
		$products = [];
		foreach($collection as $product)
		{			
			array_push($products, $product);
		};
		return $products;
	}

	/**
	 	* Adds the product to the cart
	 	* Check if user is logged in or not
	 	* Generate cart session if logged in
	 	* Return json RESPONSE
	*/
    public function addProduct($product)
    {
    	$product = Product::findOrFail($product);
    	$qty = request()->qty;
    	if(!is_null($qty) AND $qty > 0){

    	} else {
    		$duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {

	            return $cartItem->id === $product->id;
	        });

	        if ($duplicates->isNotEmpty()) {
	            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
	        }
    	}

    	Cart::add($product->id, $product->name, ((!is_null($qty)) ? $qty : 1), $product->price, ['imageUrl' => $product->imageUrl])
	            ->associate('App\Product');
	    $this->updateCardDatails();

	    
	    return response()->json(['success' => 'Ok'], 200);

    	
    }

    /**
	 	* Update the CART
	 	* Conditions
	 	  * If the Quantity is less than 0, the products is removed
	 	    * If not then , it is Updated
	 	  * Return json RESPONSE
	*/
    public function updateProduct($rowId)
    {
        $data = request()->quantity;
		if($data && $data > 0)
		{
			Cart::update($rowId, request()->quantity);
			$this->updateCardDatails();
    		return response()->json(['success' => 'Ok'], 200);
		} else {
			Cart::remove($rowId);
			$this->updateCardDatails();
    		return response()->json(['success' => 'Ok'], 204);
		}
   	
    }

    /**
	 	* Remove the PRODUCT from the CART of the particular Customer
	 	* Returns json RESPONSE
	*/
    public function removeProduct($rowId)
    {

		$found = Cart::remove($rowId); 
		if(Cart::count() < 1){
			$this->clearCart();
		}
    	return response()->json(['success' => 'Ok'], 204);
    	
    }

    /**
		* Clear the CART completely
		* Returns 204 json RESPONSE
    */
    public function clearCart()
    {
    	Cart::destroy();
    	session()->forget('percent');
    	session()->forget('discount');
        session()->forget('subAfterDis');
        session()->forget('grand');
    	return  response()->json(['success' => 'Ok'], 204); 
    }
    /*
		* Return the Updated Cart Details 
    */
	public function updateCardDatails(){
		$percent = session('percent');
		if($percent){

            $percent_off = abs(round((($percent / 100) * Cart::subTotal()), 1));
            session()->put('discount', $percent_off);
            $subAfterDis = abs(round((Cart::subTotal() - $percent_off), 1));//6
            session()->put('subAfterDis', $subAfterDis);
            $grand = abs(round(($subAfterDis + Cart::tax()), 1));//8
            session()->put('grand', $grand);  

		}
	}


    /*
		* Return the Updated Cart Details 
    */
	public function getUpdatedData(){
		$percent    = (session('percent'))?? 0;
		$discount    = (session('discount'))?? 0;
        $subAfterDis = (session('subAfterDis'))?? 0;
        $tax         = Cart::tax();
		$grandTotal  = (session('discount'))? session('grand') : Cart::total();

    	return response()->json([
    			'success'      => 'Ok', 
    			'subTotal'     => Cart::subtotal(), 
    			'percent'      => $percent, 
    			'discount'     => $discount, 
    			'subAfterDis'  => $subAfterDis, 
    			'tax'          => $tax, 
    			'grand'        => $grandTotal ,  
    			'updatedQty'   => Cart::instance('default')->count()
    		], 200);
	}

    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }

}
