<?php

namespace App\Http\Controllers\Administrator;

// use App\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index(){
    	return view('payments.index');
    }

}
