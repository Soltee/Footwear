<?php

namespace App\Http\Controllers\Administrator;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.customers.index');
    }

    /*
    * Get the Custoers data via ajax
    */
    public function get(){
        $search = request()->search;

        $query = Customer::latest();
        if($search){
            $query = $query->where('first_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('email', 'LIKE', '%'.$search.'%');
         }

        $customers = $query->paginate(5);

        return response()->json([
            'customers' => $customers->items(),
            'paginate' => [
                'first_item'    => $customers->firstItem(),
                'last_item'     => $customers->lastItem(),
                'previous_page_url' => $customers->previousPageUrl(),
                'current_page'      => $customers->currentPage(),
                'next_page_url'     => $customers->nextPageUrl(),
                'current_count' => $customers->count(),
                'total_count'   => $customers->total()
            ]
        ], 200); 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $orders = $customer->orders()->with('items')->get();
        return response()->json(['customer' => $customer, 'orders' => $orders], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        ($customer->avatar) ? File::delete($customer->avatar) : '' ;
        $customer->delete();
        return response()->json([], 204);
    }
}
