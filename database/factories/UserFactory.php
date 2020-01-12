<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'avatar' => function(){
            $arr = ['1.jpg', '2.jpg', '3.jpg', '5.jpg', '6.jpg','12.jpg', '11.jpg', '15.jpg', '9.jpg', '10.jpg'];
            $random =  Arr::random($arr);
            return '/customers/' . $random;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'created_at' => function(){
            return \Carbon\Carbon::now()->subDays(rand(0, 20))->format('Y-m-d');
        }
    ];
});
$factory->define(App\Administrator::class, function (Faker $faker) {
    return [
        'avatar' => $faker->name . ".jpg",
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


