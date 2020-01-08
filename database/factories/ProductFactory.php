<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductImages;
use Faker\Generator as Faker;
use App\Category;
use App\Subcategory;

$factory->define(Product::class, function (Faker $faker) {
    return [
    	'category_id' => function(){
    		foreach ([1,2,3,4] as $n) {
                return   $n;
            }
    	},
        'subcategory_id' => function(){
            foreach ([1,2,3,4] as $n) {
                return   $n;
            }
        },
    	'imageUrl' => function(){
            foreach ([1,2,3,4,5] as $n) {
                return   $n . ".jpg";
            }
        },
    	'name' => $faker->title,
    	'price' => $faker->unique()->numberBetween(1, 100),
        'qty' => $faker->unique()->numberBetween(1, 100),
        'visible' => collect([true, false])->random()
    ];
});


$factory->define(ProductImages::class, function (Faker $faker) {
    return [
    ];
});
