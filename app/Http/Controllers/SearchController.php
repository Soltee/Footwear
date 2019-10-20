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
    	// $param = request('param');
    	$results = [];
        $total   = count($results);
    	$products = Products::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
    	foreach ($products as $product) {
    		array_push($results, $product);
    	}
    	$customers = Customer::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
    	foreach ($customers as $customer) {
    		array_push($results, $customer);
    	}

    	return response()->json(['results' => $results, 'total' => $total], 200);
    }

    public function searchProuducts($param)
    {
    	// $param = request('param');
    	$products = Products::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
    	return response()->json(['products' => $products], 200);
    }

    public function searchCustomers($param)
    {
    	// $param = request('param');
    	$customers = Customer::where('name', 'LIKE', '%'.$param.'%')->latest()->get();
    	return response()->json(['customers' => $customers], 200);
    }
}
