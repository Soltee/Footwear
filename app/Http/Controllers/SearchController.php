<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Products;
use App\Categories;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
	public function search($param)
    {
    
        $total   = 0;
    	$products = Products::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
        $totalProducts = $products->count();
        $total += $totalProducts;
    	
    	$customers = Customer::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
        $totalCustomers = $customers->count();
        $total += $totalCustomers;
    	
    	return response()->json(['products' => $products, 'customers' => $customers, 'totalProducts' => $totalProducts, 'totalCustomers' => $totalCustomers , 'total' => $total], 200);
    }

    public function searchProuducts($param)
    {
    	// $param = request('param');
    	$products = Products::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
    	return response()->json(['products' => $products, 'total' => $products->count()], 200);
    }

    public function searchCustomers($param)
    {
    	// $param = request('param');
    	$customers = Customer::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
    	return response()->json(['customers' => $customers, 'total' => $customers->count()], 200);
    }
}
