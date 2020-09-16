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
        // dd($product);
        $category     = $product->category;
        $subcategory  = $product->subcategory;
        $images       = $product->images;
        $reviews      = $product->reviews()->with('customer')->get();
        return view('administrator.reviews.index', compact('product', 'category', 'subcategory', 'images', 'reviews'));
    }


}
