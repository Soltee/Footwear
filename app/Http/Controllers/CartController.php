<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
	/**
	 	* Check if The Product is Already Added in the Cart
	 	* Used in Product.vue
	*/
	public function isProductAlreadyAdded(Products $products){
		return response()->json(['isAdded' => Cart::session(auth('customer')->user()->id)->get($products->id) ?? false  ], 200);
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
			'cartProducts' => $this->getContent(),
			'totalQty' => Cart::session($this->guard()->id)->getTotalQuantity() ,
			'grandTotal' => Cart::session($this->guard()->id)->getTotal()
		], 200);
	
	}    

	/**
	 	* CART PAGE OF CUSTOMER
	 	* Return @view CART
	*/
	public function show(){
		$products = Cart::session($this->guard()->id)->getContent();
		$totalQuantity = Cart::session($this->guard()->id)->getTotalQuantity();
		$subTotal = (Cart::session($this->guard()->id)->getSubTotal()) ?? false;
		$grandTotal = (Cart::session($this->guard()->id)->getTotal()) ?? false;
		// dd($products);
		return view('home.cart', compact('products', 'totalQuantity', 'subTotal', 'grandTotal'));
	}

	/**
	 	* Get Cart Products according to Logged in User
	 	* Loops all the products, push to new array AND 
	 		returns the @ARRAY
	*/
	public function getContent(){
		$collection = Cart::session($this->guard()->id)->getContent();
		$products = [];
		foreach($collection as $product)
		{			
			array_push($products, $product);
		};
		return $products;
	}

	/**
	 	* Adds the product to the cart
	 	* Return json RESPONSE
	*/
    public function addProduct(Products $products)
    {

		Cart::session($this->guard()->id);    
    	Cart::add([
		    'id' => $products->id,
		    'name' => $products->name,
		    'price' => $products->price,
		    'quantity' => 1,
		    'attributes' => [
		    		'imageUrl' => $products->imageUrl
		    	]
		]);	

    	return response()->json(['success' => 'Ok'], 200);
    }

    /**
	 	* Update the CART
	 	* Conditions
	 	  * If the Quantity is less than 0, the products is removed
	 	    * If not then , it is Updated
	 	  * Return json RESPONSE
	*/
    public function updateProduct(Products $products)
    {
		$found = Cart::session($this->guard()->id)->get($products->id); 
		if($found && request('quantity') > 0)
		{
			Cart::session($this->guard()->id)->update($found->id, [
				    'quantity' => array(
					        'relative' => false,
					        'value' => request('quantity')
						),
			]);
    		return response()->json(['success' => 'Ok'], 200);
		} else {
			Cart::session($this->guard()->id)->remove($found->id);
    		return response()->json(['success' => 'Ok'], 204);
		}
   	
    }

    /**
	 	* Remove the PRODUCT from the CART of the particular Customer
	 	* Returns json RESPONSE
	*/
    public function removeProduct(Products $products)
    {

		$found = Cart::session($this->guard()->id)->get($products->id);  
		Cart::session($this->guard()->id)->remove($found->id); 

    	return response()->json(['success' => 'Ok'], 204);
    	
    }

    /**
		* Clear the CART completely
		* Returns 204 json RESPONSE
    */
    public function clearCart()
    {
    	return (Cart::session($this->guard()->id)->clear()) ? response()->json(['success' => 'Ok'], 204) : '';

    }

    /*
		* Return the subTotal 
    */
	public function getUpdatedData(){
    	return response()->json(['success' => 'Ok', 'subTotal' =>  Cart::session($this->guard()->id)->getSubTotal(), 'updatedQty' => Cart::session($this->guard()->id)->getTotalQuantity()], 200);
	}

    /**
		* Returns the Authenticated USER via 'guard'
    */
    public function guard()
    {
    	return Auth::guard('customer')->user();
    }

}
