<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(Category $category){
    	$subcategories = Subcategory::latest()->where('category_id', $categories->id)->get();
    	return response()->json(['subcategories' => $subcategories], 200);
    }
}
