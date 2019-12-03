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
    	
        $products = Products::latest()->paginate(10);
        return view('welcome', compact('products'));

    }

    public function categories(){
        return response()->json(['brands' => Categories::all(), 'subcategories' => Subcategories::all()], 200);
    }

    public function searchShoes($key){
        $shoes = Products::where('name', 'LIKE', $key . '%')->get();
        $countResult = ($shoes->count() > 0) ? true : false;
         return response()->json(['shoes' => $shoes, 'countResult' => $countResult], 200);
    }

    public function shoes()
    {
        $categories = Categories::all();

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


