<?php

namespace App\Http\Controllers\Administrator;

use App\Product;
use App\Customer;
use App\Category;
use App\Review;
use App\Order;
use App\Order_Item;
use App\Administrator;
use App\Charts\GroupChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function __construct()
    {
     	$this->middleware('auth:administrator');
    }

    public function index()
    {
        $products_query      = Product::latest();
        $categories_query    = Category::latest();
        $customers_query     = Customer::latest();
        $orders_query        = Order::latest();
        $order_items_query   = Order_Item::latest();


        $today_users      = Customer::whereDate('created_at', today())->count();
        $yesterday_users  = Customer::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = Customer::whereDate('created_at', today()->subDays(2))->count();
        $users_last_ten_days_ago = Customer::whereDate('created_at', '<=', today()->subDays(10))->count();

        $today_products      = Product::whereDate('created_at', today())->count();
        $yesterday_products  = Product::whereDate('created_at', today()->subDays(1))->count();
        $products_2_days_ago = Product::whereDate('created_at', today()->subDays(2))->count();
        $products_last_ten_days_ago = Product::whereDate('created_at', '<=', today()->subDays(10))->count();

        $today_orders      = Order::whereDate('created_at', today())->count();
        $yesterday_orders  = Order::whereDate('created_at', today()->subDays(1))->count();
        $orders_2_days_ago = Order::whereDate('created_at', today()->subDays(2))->count();
        $orders_last_ten_days_ago = Order::whereDate('created_at', '<=', today()->subDays(10))->count();

        $chart = new GroupChart;
        $chart->labels(['10 days ago', '2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Customers', 'line', [$users_last_ten_days_ago, $users_2_days_ago, $yesterday_users, $today_users])->options([
                'color' => '#18A52C',
            ]);;

        $chart->dataset('Products', 'line', [$products_last_ten_days_ago, $products_2_days_ago, $yesterday_products, $today_products])->options([
                'color' => '#18A52C',
            ]);;

        $chart->dataset('Orders', 'line', [$orders_last_ten_days_ago, $orders_2_days_ago, $yesterday_orders, $today_orders])->options([
                'color' => '#18A52C',
            ]);

        $categories   = $categories_query->count();
        $products     = $products_query->count();
        $customers    = $customers_query->count();
        $orders       = $orders_query->count();

    	$grandTotals  = $orders_query->pluck('grand');

        $sales        = 0;
        foreach ($grandTotals as $grand) {
            $sales   += $grand;
        }

        $orderItems   = $order_items_query->pluck('quantity');

        $items        = 0;
        foreach ($orderItems as $amt) {
            $items   += $amt;
        }

    	return view('administrator.dashboard', compact('categories', 'products' ,'customers', 'sales', 'orders', 'items' ,'chart'));
    }

    public function profile(){
        $admin = Auth::guard('administrator')->user();
        return view('administrator.profile', compact('admin'));
    }

    public function update(Administrator $administrator, Request $request)
    {
         // dd($request->all());
        $data = $this->validate($request, [
            'first_name' => ['required', 'string','min:4', 'max:255'],
            'last_name' => ['required', 'string','min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
         // dd($request->all());
       if($request->hasFile('avatar')){
            $this->validate($request, [
                'avatar' => ['required','file', 'image', 'mimes:jpeg,png,gif,webp', 'max:2048'],
            ]);
            $file = $request->file('avatar');
            $basename  = \Illuminate\Support\Str::random();
            $original  = 'ad-' . $basename . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('admin', $original, 'public');

            $avatarPath = ['avatar' => $path];
        }

        if($request->input('password')){
            $ps = $this->validate($request, [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $passW = ['password' => bcrypt($ps)];
        }
        $this->guard()->update(array_merge([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email']
        ], $avatarPath ?? [], $passW ?? []));
        

        return response()->json(['success' => 'Ok', 'avatar' => $avatarPath ?? null], 200);
    }

    protected function guard(){
        return Auth::guard('administrator')->user();
    }
}
