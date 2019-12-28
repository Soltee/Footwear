<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use App\Categories;
use App\Subcategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\customMail;

class WelcomeController extends Controller
{

    public function index(Request $request)
    {
    	
        $products = Products::latest()->paginate(4);
        $adidas = Products::latest()->where('subcategory_id', 2)->take(4)->paginate();
        return view('welcome', compact('products', 'adidas'));

    }

    public function categories(){
        return response()->json(['categories' => Categories::orderBy('name')->with('subcategories')->get()], 200);
    }

    public function searchShoes($key){
        $shoes = Products::where('name', 'LIKE', $key . '%')->get();
        $count = $shoes->count();
        $countResult = ($count > 0) ? true : false;
         return response()->json(['shoes' => $shoes, 'count' => $count, 'countResult' => $countResult], 200);
    }

    public function shoes()
    {
        $categories = Categories::orderBy('name')->with('subcategories')->get();

        if(request()->category){
            $products = Products::where('category_id', request()->id)->paginate(8);
            $count = count($products);
        } elseif (request()->subcategory) {
            $products = Products::where('subcategory_id', request()->id)->paginate(8);
            $count = count($products);
        } else {
            $products = Products::latest()->paginate(8);
            $count = count($products);
        }

        return view('home.shoes', compact('products', 'categories', 'count'));
    }

    public function show(Products $products, string $slug)
    {
        $paginate = Products::latest()->where('category_id', $products->category_id)->paginate(6);
        $recommended = json_encode($paginate->items());
        return view('home.show', compact('products', 'recommended'));
    }

    public function test(Request $request){
    	$email = $request->input('email');
    	$data = [$request->input('message')];
    	 Mail::send('email', $data, function($message)  use ($email) {
 
            $message->to($email, $email)
 
            ->subject('EMail Verification');
        });
    
	    if( count(Mail::failures()) > 0 ){
	        Session::flash('message','There seems to be a problem. Please try again in a while'); 
	 	    return redirect()->back(); 
	    }else{                      
	        Session::flash('message','Thanks for your message. Please check your mail for more details!'); 
	        return redirect()->back();
	    }
	}

}


