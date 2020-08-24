<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use App\Product;
use App\Customer;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'customer_id' => function(){
    		$customers = Customer::inRandomOrder()->pluck('id')->toArray();
    		return  Illuminate\Support\Arr::random($customers);
    	},
    	'product_id' => function(){
    		$customers = Product::inRandomOrder()->pluck('id')->toArray();
    		return  Illuminate\Support\Arr::random($customers);
    	},
    	'rating' => function(){
    		return  Illuminate\Support\Arr::random([1,2,3,4,5]);    		
    	},
    	'message' => $faker->lastName
    ];
});
