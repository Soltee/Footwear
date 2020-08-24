<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Products;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

class CouponController extends Controller
{
    public function apply(Request $request){
    	$data = $this->validate($request, ['code' => 'required|string|min:4']);
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
                // $percent_off = ($coupon->percent / 100) * Cart::subTotal();///4 
                // $request->session()->put('discount', $percent_off);
                // $subAfterDis = (Cart::subTotal() - $percent_off);//6
                // $request->session()->put('subAfterDis', $subAfterDis);
                // $tax = Cart::tax();//2
                // $grand = ($subAfterDis + Cart::tax());//8
                // $request->session()->put('grand', $grand);  
                // return response()->json([
                //         'valid' => true,
                //         'message' => 'Your coupon is successfully redeemed.',
                //         'discount' => $percent_off, 
                //         'subAfterDis' => $subAfterDis,
                //         'tax' => $tax,
                //         'grand' =>  $grand
                //     ], 201);

                $percent = $coupon->percent;
                $request->session()->put('percent', $percent);
                $percent_off = abs(round((($percent / 100) * Cart::subTotal()), 1));///4 
                $request->session()->put('discount', $percent_off);
                $subAfterDis = abs(round((Cart::subTotal() - $percent_off), 1));//6
                $request->session()->put('subAfterDis', $subAfterDis);
                $tax = Cart::tax();//2
                $grand = abs(round(($subAfterDis + Cart::tax()), 1));//8
                $request->session()->put('grand', $grand);  
                return response()->json([
                        'valid'        => true,
                        'message'      => 'Your coupon is successfully redeemed.',
                        'percent'      => $percent, 
                        'discount'     => $percent_off, 
                        'subAfterDis'  => $subAfterDis,
                        'tax'          => $tax,
                        'grand'        => $grand
                    ], 201);  
            }
                  
        } else {
            return response()->json([
                    'message' => 'Your coupon doesnot match any of ours.',
                ], 204);
        }
        
    }
}
