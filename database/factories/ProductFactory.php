<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\ProductImages;
use Faker\Generator as Faker;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Arr;


$factory->define(Product::class, function (Faker $faker) {
    return [
    	'category_id' => function(){
            $category = Category::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($category);
        },
        'subcategory_id' => function(){
            $subcategory = Subcategory::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($subcategory);
        },
        'imageUrl' => function(){
            $urls = [
                 'products/b2.jpg', 
                'products/m2.jpg',
                'products/w2.jpg',
                'products/c2.jpg',
                'products/b3.jpg',
                'products/m3.jpg',
                'products/m4.jpg',
                'products/b4.jpg',
                'products/c4.jpg',
                'products/w7.jpg',
                'products/w8.jpg'
            ];
            return  Arr::random($urls);
        },
        'name' => $faker->title,
        'slug' => $faker->title . '-shoe',
    	'price' => $faker->unique(true)->numberBetween(100, 500),
        'qty' => $faker->unique(true)->numberBetween(1, 30),
        'created_at' => function(){
            $dates = [1,2,3,5,8, 10, 20];
            return  Arr::random($dates);
        },
        'featured' => function(){
            $bools = [true, false];
            return Arr::random($bools);
        }
    ];
});


$factory->define(ProductImages::class, function (Faker $faker) {
    return [
        'product_id' => function(){
            $products = Product::inRandomOrder()->pluck('id')->toArray();
            return  Arr::random($products);
        },
        'imageUrl' => function(){
            $urls = [
                'products/b2.jpg', 
                'products/b3.jpg',
                'products/b4.jpg',
                'products/b5.jpg',
                'products/b6.jpg',
                'products/b7.jpg',
                'products/m1.jpg',
                'products/m2.jpg',
                'products/m3.jpg',
                'products/m4.jpg',
                'products/m5.jpg',
                 'products/m6.jpg', 
                'products/m7.jpg',
                'products/m8.jpg',
                'products/m9.jpg',
                'products/w1.jpg',
                'products/w2.jpg',
                'products/w3.jpg',
                'products/w4.jpg',
                'products/w5.jpg',
                'products/w6.jpg',
                'products/w7.jpg',
                 'products/w8.jpg', 
                'products/c1.jpg',
                'products/c2.jpg',
                'products/c3.jpg',
                'products/c4.jpg',
            ];

            return  Arr::random($urls);
        },
        'thumbnail' =>function(){
            $urls = [
                'products/b2.jpg', 
                'products/b3.jpg',
                'products/b4.jpg',
                'products/b5.jpg',
                'products/b6.jpg',
                'products/b7.jpg',
                'products/m1.jpg',
                'products/m2.jpg',
                'products/m3.jpg',
                'products/m4.jpg',
                'products/m5.jpg',
                 'products/m6.jpg', 
                'products/m7.jpg',
                'products/m8.jpg',
                'products/m9.jpg',
                'products/w1.jpg',
                'products/w2.jpg',
                'products/w3.jpg',
                'products/w4.jpg',
                'products/w5.jpg',
                'products/w6.jpg',
                'products/w7.jpg',
                 'products/w8.jpg', 
                'products/c1.jpg',
                'products/c2.jpg',
                'products/c3.jpg',
                'products/c4.jpg',
            ];

            return  Arr::random($urls);
        }
    ];
});
