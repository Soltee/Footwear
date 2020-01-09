<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Category ;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\customMail;

class WelcomeController extends Controller
{

    public function index(Request $request)
    {
    	
        $products = Product::latest()->paginate(4);
        $adidas = Product::latest()->where('subcategory_id', )->paginate(4);
        return view('welcome', compact('products', 'adidas'));

    }

    public function categories(){
        return response()->json(['categories' => Category::orderBy('name')->with('subcategories')->get()], 200);
    }

    public function searchShoes($key){
        $shoes = Product::where('name', 'LIKE', $key . '%')->get();
        $count = $shoes->count();
        $countResult = ($count > 0) ? true : false;
         return response()->json(['shoes' => $shoes, 'count' => $count, 'countResult' => $countResult], 200);
    }

    public function shoes()
    {
        $categories = Category::orderBy('name')->with('subcategories')->get();

        if(request()->category){
            // dd(request()->id);
            $products = Product::where('category_id', request()->id)->paginate(8);

            $count = count($products);
        } elseif (request()->subcategory) {
            $products = Product::where('subcategory_id', request()->id)->paginate(8);
            $count = count($products);
        } else {
            $products = Product::latest()->paginate(8);
            $count = count($products);
        }

        return view('home.shoes', compact('products', 'categories', 'count'));
    }

    public function show($product, $slug)
    {   
        $product = Product::findOrFail($product);
        $paginate = Product::latest()->where('category_id', $product->category_id)->paginate(6);
        $category = ($product->subcategories)?? null;
        $recommended = json_encode($paginate->items());

        return view('home.show', compact('product', 'category', 'recommended'));
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


