<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use App\Category;
use App\Subcategory;
use App\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\customMail;

class WelcomeController extends Controller
{

    public function index(Request $request)
    {
    	
        $products = Product::latest()->paginate(4);
        $featured = Product::inRandomOrder()->where('featured', true)->paginate(4);
        return view('welcome', compact('products', 'featured'));

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
        $category    = request()->category;
        $subcategory = request()->subcategory;
        $from        = request()->from;
        $to          = request()->to;
        $categories = Category::orderBy('name')->with('subcategories')->get();

        if($category){
            $category      = Category::findOrfail($category);
            $p             = Product::where('category_id', $category->id)->paginate(9);
            $count         = count($p);
        } elseif ($subcategory) {
            $subcategory = Subcategory::findOrfail($subcategory);
            $p = Product::where('subcategory_id', $subcategory->id)->paginate(9);
            $count = count($p);
        } elseif (request()->type) {
            // dd(request()->type);
            $subcategory = Subcategory::where('name', request()->type)->first();
            // dd($subcategory->id);
            $p = Product::where('subcategory_id', $subcategory->id)->paginate(9);
            // dd($p);
            $count = count($p);
        } elseif ($to) {

            $p = Product::whereBetween('price', [$from, $to])->paginate(9);
            $count = count($p);
        } else {
            $p = Product::latest()->paginate(9);
            $count = count($p);
        }

        $products = $p->items();
        $first    = $p->appends(request()->input())->firstItem();
        $last     = $p->appends(request()->input())->lastItem();
        $next     = $p->appends(request()->input())->nextPageUrl();
        $prev     = $p->appends(request()->input())->previousPageUrl();
        $current  = $p->appends(request()->input())->currentPage();
        $total    = $p->appends(request()->input())->total();

        return view('home.shoes', compact('products', 'next', 'prev', 'current', 'categories','category', 'subcategory', 'count', 'first', 'last', 'total'));
    }

    public function show($product, $slug)
    {   
        $product        = Product::findOrFail($product);
        $images         = $product->images;
        $images_count   = count($images);
        $similar        = Product::latest()->where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->get();
        $similar_count  = count($images);
        $category       = ($product->subcategories)?? null;
        $auth = Auth::guard('customer')->user() ?? null;
        return view('home.show', compact('product', 'images_count', 'images', 'category', 'auth', 'similar', 'similar_count'));
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


