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
                'storage/products/b2.jpg', 
                'storage/products/m2.jpg',
                'storage/products/w2.jpg',
                'storage/products/c2.jpg',
                'storage/products/b3.jpg',
                'storage/products/m3.jpg',
                'storage/products/m4.jpg',
                'storage/products/b4.jpg',
                'storage/products/c4.jpg',
                'storage/products/w7.jpg',
                'storage/products/w8.jpg'
            ];
            return  Arr::random($urls);
        },
        'name'           => $faker->title,
        'average_rating' => $faker->numberBetween(1, 5),
        'slug'           => $faker->title . '-shoe',
    	'price'          => $faker->unique(true)->numberBetween(100, 500),
        'qty'            => $faker->unique(true)->numberBetween(0, 20),
        'description'    => $faker->text(200),
        'created_at'     => function(){
            $dates = [1,2,3,5,8, 10, 20];
            return  Arr::random($dates);
        },
        'featured'       => function(){
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
                'storage/products/b2.jpg', 
                'storage/products/b3.jpg',
                'storage/products/b4.jpg',
                'storage/products/b5.jpg',
                'storage/products/b6.jpg',
                'storage/products/b7.jpg',
                'storage/products/m1.jpg',
                'storage/products/m2.jpg',
                'storage/products/m3.jpg',
                'storage/products/m4.jpg',
                'storage/products/m5.jpg',
                'storage/products/m6.jpg', 
                'storage/products/m7.jpg',
                'storage/products/m8.jpg',
                'storage/products/m9.jpg',
                'storage/products/w1.jpg',
                'storage/products/w2.jpg',
                'storage/products/w3.jpg',
                'storage/products/w4.jpg',
                'storage/products/w5.jpg',
                'storage/products/w6.jpg',
                'storage/products/w7.jpg',
                 'storage/products/w8.jpg', 
                'storage/products/c1.jpg',
                'storage/products/c2.jpg',
                'storage/products/c3.jpg',
                'storage/products/c4.jpg',
            ];

            return  Arr::random($urls);
        },
        'thumbnail' =>function(){
            $urls = [
                'storage/products/b2.jpg', 
                'storage/products/b3.jpg',
                'storage/products/b4.jpg',
                'storage/products/b5.jpg',
                'storage/products/b6.jpg',
                'storage/products/b7.jpg',
                'storage/products/m1.jpg',
                'storage/products/m2.jpg',
                'storage/products/m3.jpg',
                'storage/products/m4.jpg',
                'storage/products/m5.jpg',
                 'storage/products/m6.jpg', 
                'storage/products/m7.jpg',
                'storage/products/m8.jpg',
                'storage/products/m9.jpg',
                'storage/products/w1.jpg',
                'storage/products/w2.jpg',
                'storage/products/w3.jpg',
                'storage/products/w4.jpg',
                'storage/products/w5.jpg',
                'storage/products/w6.jpg',
                'storage/products/w7.jpg',
                 'storage/products/w8.jpg', 
                'storage/products/c1.jpg',
                'storage/products/c2.jpg',
                'storage/products/c3.jpg',
                'storage/products/c4.jpg',
            ];

            return  Arr::random($urls);
        }
    ];
});
