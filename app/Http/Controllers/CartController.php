<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Products;
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
	public function isProductAlreadyAdded(Products $products){
		return response()->json(['isAdded' => Cart::get($products->id) ], 200);
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
		$products = Cart::content();
		$totalQuantity = 	Cart::instance('default')->count();
		$subTotal = Cart::subtotal();
		$tax = Cart::tax();
		$grandTotal = Cart::total();
		return view('home.cart', compact('products', 'totalQuantity', 'subTotal', 'tax', 'grandTotal'));
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
    public function addProduct(Products $products)
    {

    	$duplicates = Cart::search(function ($cartItem, $rowId) use ($products) {

            return $cartItem->id === $products->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
        }

        Cart::add($products->id, $products->name, 1, $products->price, ['imageUrl' => $products->imageUrl])
            ->associate('App\Products');

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
			
    		return response()->json(['success' => 'Ok'], 200);
		} else {
			Cart::remove($rowId);
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

    	return response()->json(['success' => 'Ok'], 204);
    	
    }

    /**
		* Clear the CART completely
		* Returns 204 json RESPONSE
    */
    public function clearCart()
    {
    	Cart::destroy();
    	return  response()->json(['success' => 'Ok'], 204); 
    }

    /*
		* Return the subTotal 
    */
	public function getUpdatedData(){
    	return response()->json(['success' => 'Ok', 'subTotal' => Cart::subtotal(), 'tax' => Cart::tax(), 'grand' => Cart::total() ,  'updatedQty' => Cart::instance('default')->count()], 200);
	}

    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }

}
