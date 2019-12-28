<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Products;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

class CouponController extends Controller
{
    public function redeem(Request $request){
    	$data = $this->validate($request, ['code' => 'min:4']);
    	// $coupon = Coupon::where('code', $data['code'])->get();
        $coupon = DB::table('coupons')
                ->where('code', $data['code'])
                ->whereDate('expires_on', '<' ,\Carbon\Carbon::today()->toDateString())
                ->first();
        // dd($coupon->code);
        if($coupon){
            $percent_off = ($coupon->percent / 100) * Cart::subTotal();///4            
        }
        $request->session()->put('discount', $percent_off);
    	$subAfterDis = (Cart::subTotal() - $percent_off);//6
        $request->session()->put('subAfterDis', $subAfterDis);
    	$tax = Cart::tax();//2
    	$grand = ($subAfterDis + Cart::tax());//8
        $request->session()->put('grand', $grand);

    	return response()->json([
    				'discount' => $percent_off, 
    				'subAfterDis' => $subAfterDis,
    				'tax' => $tax,
    				'grand' =>  $grand
                ], 200);
    }
}
