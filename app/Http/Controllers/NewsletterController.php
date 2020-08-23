<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request){
    	$data = $request->validate([
    		'email' => 'required|email'
    	]);

    	if($this->isSubscribed($data['email'])){
    		return response()->json(['is_subscribed' => true], 200);
    	}

    	Newsletter::subscribe($data['email']);

    	return response()->json(['is_subscribed' => true], 201);    	
    }

    public function isSubscribed($user)
    {
    	return Newsletter::isSubscribed($user);
    }
}
