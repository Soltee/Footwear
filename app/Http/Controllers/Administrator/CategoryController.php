<?php

namespace App\Http\Controllers\Administrator;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    
	public function index()
	{
		$categories = Category::latest()->get();
		return response()->json(['categories' => $categories], 200);
	}

    public function getCategories()
    {
        $category = request()->category;
        if($category){
            $subcategories = Subcategory::where('category_id', $category)->rderBy('name')->get();
            return response()->json([
                'subcategories' => $subcategories
            ], 200);
        } else {
            $categories = Category::orderBy('name')->with('subcategories')->get();
            return response()->json([
                'categories' => $categories
            ], 200);
        }
        
    }

    public function store(Request $request)
    {
    	// dd($request->all());
    	$data = $this->validate($request, [
    		'name' => ['string', 'min:3']
    	]);

    	$category = Category::create([
    		'name' => $data['name']
    	]);

    	return response()->json(['category' => $category], 201);
    }
}
