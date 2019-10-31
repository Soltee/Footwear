<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
	public function isProductAlreadyAdded(Products $products){
		return response()->json(['isAdded' => Cart::session(auth('customer')->user()->id)->get($products->id) ?? false  ], 200);
	} 

	public function getCartProducts(){

		
		return response()->json([
			'cartProducts' => $this->getContent(),
			'totalQty' => Cart::session($this->guard()->id)->getTotalQuantity() ,
			'grandTotal' => Cart::session($this->guard()->id)->getTotal()
		], 200);
	
	}    

	public function show(){
		$products = Cart::session($this->guard()->id)->getContent();
		$subTotal = (Cart::session($this->guard()->id)->getSubTotal()) ?? false;
		$grandTotal = (Cart::session($this->guard()->id)->getTotal()) ?? false;
		// dd($products);
		return view('home.cart', compact('products', 'subTotal', 'grandTotal'));
	}

	public function getContent(){
		$collection = Cart::session($this->guard()->id)->getContent();
		$products = [];
		foreach($collection as $product)
		{			
			array_push($products, $product);
		};
		return $products;
	}

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
     	// return response()->json(['success' => 'Ok'], 204);
   	
    }

    public function removeProduct(Products $products)
    {

		$found = Cart::session($this->guard()->id)->get($products->id);  
		Cart::session($this->guard()->id)->remove($found->id); 

    	return response()->json(['success' => 'Ok'], 204);
    	
    }

    public function clearCart()
    {
    	// return response()->json(['success' => 'Ok'], 204);
    	return (Cart::session($this->guard()->id)->clear()) ? response()->json(['success' => 'Ok'], 204) : '';

    }

    public function guard()
    {
    	return Auth::guard('customer')->user();
    }
}
