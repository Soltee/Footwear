<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
	{
		return $this->middleware('customer');
	}

	public function index()
    {

  		// Cart::clear();
		// Cart::session(auth()->user()->id)->clear();
    	$cartCollection = Cart::session(auth()->user()->id)->getContent();
    	$shipping = (Cart::session(auth()->user()->id)->getCondition('Express Shipping $15')) ? Cart::session(auth()->user()->id)->getCondition('Express Shipping $15') : 0;
		// $shipping->getTarget(); // the target of which the condition was applied
		// $shipping->getName(); // the name of the condition
		// $shipping->getType(); // the type
		// $shipping->getValue(); // the value of the condition
		// $shipping->getAttributes();

    	return view('cart', compact('cartCollection', 'shipping'));
    }

    public function add(Products $products)
    {
		return (Cart::session(auth()->user()->id)->get($products->id)) ? $this->updateItem($item) : $this->addItem($item);

    }

    public function addItem($products)
    {

		Cart::session(auth()->user()->id);    
    	Cart::add([
		    'id' => $item->id,
		    'name' => $item->name,
		    'price' => $item->price - Helper::setPriceAfterDiscount($item->price, $item->discount),
		    'quantity' => 1,
		    'attributes' => [
		    		'image' => $item->image,
		    		'discount' => $item->discount,
		    	]
		]);	


		$discountCondition = new \Darryldecode\Cart\CartCondition(array(
		    'name' => 'Express Shipping $15',
		    'type' => 'shipping',
		    'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
		    'value' => '+15',
		    'order' => 1
		));

		Cart::session(auth()->user()->id)->condition($discountCondition);

    	return redirect()->back()->with('success', 'Item Added To Cart!');
    }

    public function updateItem(Products $products)
    {
		$found = Cart::session(auth()->user()->id)->get($item->id); 
		if($found && request('quantity') > 0)
		{
			Cart::session(auth()->user()->id)->update($found->id, [
				    'quantity' => array(
					        'relative' => false,
					        'value' => request('quantity')
						),
			]);
    		return redirect()->back()->with('success', 'Item updated to your Cart.');
		} else {
			Cart::session(auth()->user()->id)->remove($found->id);
    		return redirect()->back()->with('success', 'Item is completely removed from the cart.');
		}
    	
    }

    public function removeItem($item)
    {

		$found = Cart::session(auth()->user()->id)->get($item);  
		Cart::session(auth()->user()->id)->remove($found->id); 

    	return redirect()->back()->with('success', 'Item removed from the card!');
    	
    }
}
