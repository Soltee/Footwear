<?php

namespace App\Http\Controllers\Administrator;

use App\Product;
use App\ProductImages;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
    public function index()
    {
        return view('administrator.products.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('administrator.products.create', compact('categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        $product       = $product;
        $category      = $product->category;
        $subcategory   = $product->subcategory;
        $images        = $product->images;
        $reviews       = $product->reviews()->with([
                                    'customer' => function($query)
                                        {
                                            $query->select('id', 'avatar', 'first_name', 'last_name');
                                         }
                                    ])->get();
        // dd($category);

        return view('administrator.products.show', compact('product', 'category', 'subcategory', 'images', 'reviews'));

    }


    
}
