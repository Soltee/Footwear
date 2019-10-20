<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index()
	{
		$categories = Categories::latest()->get();
		return response()->json(['categories' => $categories], 200);
	}

    public function store(Request $request)
    {
    	// dd($request->all());
    	$data = $this->validate($request, [
    		'name' => ['string', 'min:3']
    	]);

    	$category = Categories::create([
    		'name' => $data['name']
    	]);

    	return response()->json(['category' => $category], 201);
    }
}
