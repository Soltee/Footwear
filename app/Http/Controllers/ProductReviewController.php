<?php

namespace App\Http\Controllers;

use App\Review;
use App\Product;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
	 /* Get produc tReview */
    public function index(Product $product)
    {
    	// $review = 
    	// $is_reviewed = $product->reviews
    	$reviews     = $product->reviews()->with([
                                    'customer' => function($query)
                                        {
                                            $query->select('id', 'avatar', 'first_name', 'last_name');
                                         }
                                    ])->get();
    	$has_reviews = (count($reviews) > 0) ? true : false;

    	return response()->json(['reviews' => $reviews, 'has_reviews' => $has_reviews], 200);    	
    }

    /* Review Product*/
    public function store(Request $request, Product $product)
    {
    	$auth = Auth::guard('customer')->user() ?? null;
    	abort_if(!$auth, 403);

    	$data = $request->validate([
    		'customer_id' => 'required|string',
    		'rating'      => 'required|numeric',
    		'message'     => 'required'
    	]);

    	$product->reviews()->create([
    		'customer_id' => $auth->id,
    		'rating'      => $data['rating'],
    		'message'     => $data['message']
    	]);
    	$average = abs(round($product->reviews()->avg('rating'), 1));
    	$product->update([
    		'average_rating' => $average
    	]);

    	return response()->json(['success' => 'Ok!', 'average' => $average], 201);
    }

}
