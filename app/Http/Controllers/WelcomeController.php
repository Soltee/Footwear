<?php

namespace App\Http\Controllers;

use Cart;
use App\Products;
use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WelcomeController extends Controller
{
	public $isAuthenticated;

    public function index(Request $request)
    {
    	
        $products = Products::latest()->paginate(10);
        return view('welcome', compact('products'));

    }

}


