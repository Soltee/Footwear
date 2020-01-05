<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Subcategories;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function index(Categories $categories){
    	$subcategories = Subcategories::latest()->where('category_id', $categories->id)->get();
    	return response()->json(['subcategories' => $subcategories], 200);
    }
}
