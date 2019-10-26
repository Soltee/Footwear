<?php

namespace App\Http\Controllers;

use App\Products;
use App\Categories;
use Illuminate\Http\Request;
use App\Cart\ProductCollection;
class WelcomeController extends Controller
{
    public function index(Request $request)
    {
    	// $a = ['id' => 1, 'name' => 'One', 'price' => 23, 'quantity' => 2];
    	// $b = ['id' => 2, 'name' => 'Two', 'price' => 4, 'quantity' => 8];
     //    // if($request->session()->get('first'))
     //    // {
     //    //     $request->session()->push('first', $b);
     //    // } else {
     //    //     $request->session()->put('first', [$a]);
     //    // }
    	// $cart = $request->session()->get('first');
     //    dd($cart);
         // $request->session()->forget('first');

    	// $products = [];
    	// if($request->session()->has('first')){
    	// 	$v = $request->session()->get('first');
    	// 	$v2 = $request->session()->get('second');
			    		
    	// 	// array_push($products, $v);
    	// 	// array_push($products, $v2);
    	// 	// dd($request->session()->get('first'));
    	// }


    	// // dd($products);
    	// // dd(array_sum($products));
    	// foreach ($products as $product) {
    	// 	// array_pluck($pro)
    	// }
        
    	// dd($request->session()->all());

        $products = Products::latest()->paginate(10);
        return view('welcome', compact('products'));

    }

}


