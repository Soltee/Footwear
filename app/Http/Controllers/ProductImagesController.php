<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
	public function store(Request $request, $products){
		// echo $products;
		dd($request->all());
		// if($request->hasFile('photos'))
		// {
		// 	$allowedfileExtension = ['jepg','jpg','png'];
		// 	$files = $request->file('photos');
		// 	foreach($files as $file){
		// 		$filename = $file->getClientOriginalName();
		// 		$extension = $file->getClientOriginalExtension();
		// 		$check=in_array($extension,$allowedfileExtension);
		// 		//dd($check);
		// 	if($check)
		// 	{
		// 		foreach ($request->photos as $photo) {
		// 			$filename = $photo->store('productImages', 'public');
		// 			ProductImages::create([
		// 				'product_id' => $products,
		// 				'filename' => $filename
		// 			]);
		// 		});
		// 	}
		// }			

		return response()->json([], 201);		
	}


	public function destory(){
		return response()->json([], 204);
	}
}
