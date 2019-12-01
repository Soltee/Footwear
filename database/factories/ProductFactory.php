<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Products;
use Faker\Generator as Faker;
use App\Categories;

$factory->define(Products::class, function (Faker $faker) {
    return [
    	'category_id' => function(){
    		return Categories::inRandomOrder()->get();
    	},
    	'imageUrl' => function(){
            foreach ([1,2,3,4,5] as $n) {
                return   $n . ".jpg";
            }
        },
    	'name' => $faker->title,
    	'price' => $faker->unique()->numberBetween(1, 100),
        'qty' => $faker->unique()->numberBetween(1, 100),
        'excerpt' => $faker->sentence,
        'description' => $faker->text,
        'visible' => collect([true, false])->random()
    ];
});
