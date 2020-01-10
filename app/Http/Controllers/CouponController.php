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
    	$coupon = Coupon::where('code', $data['code'])->first();
        

        if($coupon){
            // dd($coupon->percent/100 * Cart::subTotal());
            // dd(session('discount'));
            if(session('discount')){
                return response()->json([
                    'valid' => false,
                    'message' => 'Your coupon has already been redeemed.'
                ], 200);
            }  else {
                $percent_off = ($coupon->percent / 100) * Cart::subTotal();///4 
                $request->session()->put('discount', $percent_off);
                $subAfterDis = (Cart::subTotal() - $percent_off);//6
                $request->session()->put('subAfterDis', $subAfterDis);
                $tax = Cart::tax();//2
                $grand = ($subAfterDis + Cart::tax());//8
                $request->session()->put('grand', $grand);  
                return response()->json([
                        'valid' => true,
                        'message' => 'Your coupon is successfully redeemed.',
                        'discount' => $percent_off, 
                        'subAfterDis' => $subAfterDis,
                        'tax' => $tax,
                        'grand' =>  $grand
                    ], 201); 
            }
                  
        } else {
            return response()->json([
                    'message' => 'Your coupon doesnot match any of ours.',
                ], 204);
        }
        
    }
}
