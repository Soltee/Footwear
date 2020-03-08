<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImagesController extends Controller
{
	public function index(Product $product){
		$images = ProductImages::latest()->where('product_id', $product->id)->get();
		return response()->json(['images' => $images], 200);
	}

	public function store(Request $request, $products){
		return response()->json([], 201);		
	}


	public function destroy(ProductImages $ProductImages){
		File::delete(public_path('products/' . $ProductImages->imageUrl));
		$ProductImages->delete();
		return response()->json(['success' => 'Ok'], 204);
	}
}
