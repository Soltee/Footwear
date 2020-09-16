<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Orders;
use App\Customer;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Orders::class, function (Faker $faker) {
    return [
    	'customer_id' => function(){
    		$customers = App\Customer::inRandomOrder()->pluck('id')->toArray();
    		return  Illuminate\Support\Arr::random($customers);
    	},
    	'first_name' => $faker->firstName,
    	'last_name' => $faker->lastName,
    	'email' => $faker->email,
    	'phoneNumber' => $faker->phoneNumber,
    	'city' => $faker->city,
    	'street_address' => $faker->streetAddress ,
    	'payment_method' => function(){
    		$methods = ['stripe', 'braintree', 'paypal'];
    		return Illuminate\Support\Arr::random($methods);
    	},
    	'payment_id' => $faker->bankAccountNumber,
    	'subtotal' => $faker->numberBetween($min = 100, $max = 300),
    	'discount' => $faker->numberBetween($min = 10, $max = 100),
    	'subafterdiscount' => $faker->numberBetween($min = 100, $max = 400),
    	'tax' => 200,
    	'grand' => $faker->numberBetween($min = 500, $max = 1200),
    	'created_at' => function(){
    		return \Carbon\Carbon::now()->subDays(rand(0, 20))->format('Y-m-d');
    	}
    ];
});

$factory->define(App\Order_Items::class, function (Faker $faker) {
    return [
    	'customer_id' => function(){
    		$customers = App\Customer::inRandomOrder()->pluck('id')->toArray();
    		return  Illuminate\Support\Arr::random($customers);
    	},
    	'orders_id' => function(){
    		$orders = Orders::inRandomOrder()->pluck('id')->toArray();
    		return  Illuminate\Support\Arr::random($orders);
    	},
        'product_id' => function(){
            $product = Product::inRandomOrder()->pluck('id')->toArray();
            return  Illuminate\Support\Arr::random($product);
        },
    	'name' => function(){
    		$names = App\Product::inRandomOrder()->pluck('name')->toArray();
    		return  Illuminate\Support\Arr::random($names);
    	},
    	'price' => function(){
    		$prices = App\Product::inRandomOrder()->pluck('price')->toArray();
    		return  Illuminate\Support\Arr::random($prices);
    	},
    	'quantity' => function(){
    		$quantities = App\Product::inRandomOrder()->pluck('qty')->toArray();
    		return  Illuminate\Support\Arr::random($quantities);
    	},
    	'created_at' => function(){
    		return \Carbon\Carbon::now()->subDays(rand(0, 20))->format('Y-m-d');
    	}

    ];
});