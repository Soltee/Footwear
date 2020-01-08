<?php

namespace App\Http\Controllers\Administrator;

use App\Product;
use App\Customer;
use App\Category;
use App\Orders;
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
        $today_users      = Customer::whereDate('created_at', today())->count();
        $yesterday_users  = Customer::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = Customer::whereDate('created_at', today()->subDays(2))->count();
        $users_last_ten_days_ago = Customer::whereDate('created_at', '<=', today()->subDays(10))->count();

        $today_products      = Product::whereDate('created_at', today())->count();
        $yesterday_products  = Product::whereDate('created_at', today()->subDays(1))->count();
        $products_2_days_ago = Product::whereDate('created_at', today()->subDays(2))->count();
        $products_last_ten_days_ago = Product::whereDate('created_at', '<=', today()->subDays(10))->count();

        $today_orders      = Orders::whereDate('created_at', today())->count();
        $yesterday_orders  = Orders::whereDate('created_at', today()->subDays(1))->count();
        $orders_2_days_ago = Orders::whereDate('created_at', today()->subDays(2))->count();
        $orders_last_ten_days_ago = Orders::whereDate('created_at', '<=', today()->subDays(10))->count();

        $chart = new GroupChart;
        $chart->labels(['10 days ago', '2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Customers', 'line', [$users_last_ten_days_ago, $users_2_days_ago, $yesterday_users, $today_users])->options([
                'color' => '#000000',
            ]);;

        $chart->dataset('Products', 'line', [$products_last_ten_days_ago, $products_2_days_ago, $yesterday_products, $today_products])->options([
                'color' => '#000000',
            ]);;

        $chart->dataset('Orders', 'line', [$orders_last_ten_days_ago, $orders_2_days_ago, $yesterday_orders, $today_orders])->options([
                'color' => '#000000',
            ]);;
        $products = Product::all()->count();
        $customers = Customer::all()->count();
    	$orders = Orders::all()->count();

    	return view('administrator.dashboard', compact('products' ,'customers', 'orders', 'chart'));
    }

    public function profile(){
        $administrator = Auth::guard('administrator')->user();
        return view('administrator.profile', compact('administrator'));
    }

    public function update(Administrator $administrator, Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
         // dd($request->all());
       if($request->hasFile('avatar')){
            $this->validate($request, [
                'avatar' => ['image']
            ]);
            $avatarUrl = $request->file('avatar')->store('administrator', 'public');
            $avatarPath = ['avatar' => $avatarUrl];
        }

        auth()->user()->update(array_merge([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ], $avatarPath ?? []));

        return redirect()->route('administrator-profile')->with('success', 'Profile updated.');
    }
}
