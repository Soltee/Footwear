<?php

namespace App\Http\Controllers;

use App\Products;
use App\Categories;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
    	$products = Products::latest()->paginate(10);
    	return view('welcome', compact('products'));
    }

}
