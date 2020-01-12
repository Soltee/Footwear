<?php

namespace App\Http\Controllers\Administrator;

use App\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
    	$search = request()->search;

        $query = Orders::latest();
        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%');
         }

        $orders = $query->paginate(10);

        return response()->json([
            'orders' => $orders->items(),
            'paginate' => [
                'first_item'    => $orders->firstItem(),
                'last_item'     => $orders->lastItem(),
                'previous_page_url' => $orders->previousPageUrl(),
                'current_page'      => $orders->currentPage(),
                'next_page_url'     => $orders->nextPageUrl(),
                'current_count' => $orders->count(),
                'total_count'   => $orders->total()
            ]
        ], 200);  
    }

    public function show(Orders $orders){

        return response()->json([
            'customer' => ($orders->customer)?? null,
            'orders' => $orders,
            'orders_items' => null,
        ], 200); 
    }

    public function destroy(Orders $orders){
    	$orders->delete();
    	$orders->items()->delete();
        return response()->json([
            'orders' => $orders,
        ], 204); 
    }
}
