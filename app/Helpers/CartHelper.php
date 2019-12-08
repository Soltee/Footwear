<?php

namespace App\Helpers;

use Cart;
use App\Products;

class Helpers {

	public static function guestId(){
		return substr(str_shuffle(MD5(microtime())), 0, 100);
	}

	public static function UserTypeProductAlreadyExist(string $userType = null, Products $products, string $userOrGuestId){
		return ($userType) ? Cart::session($userType->id)->get($products->id) : Cart::session($userOrGuestId)->get($products->id);
	}

}

