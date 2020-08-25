<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Review;
use App\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('administrator.reviews.index', compact('product'));
    }


    // public function getReviews(Product $product)
    // {
    //     $search = request()->search;

    //     $query = $product->reviews;
    //     if($search){
    //         $query = $query->where('rating', 'LIKE', '%'.$search.'%')
    //                         ->orWhere('message', 'LIKE', '%'.$search.'%');
    //      }

    //     $reviews = $query->paginate(5);

    //     return response()->json([
    //         'reviews' => $reviews->items(),
    //         'paginate' => [
    //             'first_item'    => $reviews->firstItem(),
    //             'last_item'     => $reviews->lastItem(),
    //             'previous_page_url' => $reviews->previousPageUrl(),
    //             'current_page'      => $reviews->currentPage(),
    //             'next_page_url'     => $reviews->nextPageUrl(),
    //             'current_count' => $reviews->count(),
    //             'total_count'   => $reviews->total()
    //         ]
    //     ], 200);  
    // }

}
