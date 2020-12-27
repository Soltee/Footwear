<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Customer;
use App\Administrator;
use App\Category;
use App\Subcategory;
use App\Product;
use App\ProductImages;
use App\Order;
use App\Order_Item;
use App\Review;
use App\Coupon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	factory(Customer::class , 20)->create();
        factory(Administrator::class)->create(['last_name' => 'Munu','first_name' => 'Admin', 'email'=>'admin@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);

        // Customer::create([
        // Administrator::create([
        //     'last_name' => 'Munu',
        //     'first_name' => 'Admin', 
        //     'email'=>'admin@example.com', 
        //     'email_verified_at' => now(), 
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
        //     'remember_token' => '3RbW346H&#F#'
        // ]);

        
        factory(Customer::class)->create(['last_name' => 'Nari','first_name' => 'role', 'email'=>'customer@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);
        // factory(Administrator::class)->create();

        $category1 = factory(Category::class)->create(['name' => 'Brands', 'slug' => 'brands' ]);
        $category2 = factory(Category::class)->create(['name' => 'Type', 'slug' => 'type' ]);

        $subcategory1 = factory(Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Featured' , 'slug' => 'featured']);
        $subcategory2 = factory(Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Adidas' , 'slug' => 'adidas']);
        $subcategory3 = factory(Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Converse' , 'slug' => 'converse']);
        $subcategory4 = factory(Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'DC' , 'slug' => 'dc']);
        $subcategory5 = factory(Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Nike' , 'slug' => 'nike']);
        $subcategory6 = factory(Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Baby' , 'slug' => 'baby']);
        $subcategory7 = factory(Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Children' , 'slug' => 'children']);
        $subcategory8 = factory(Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Men' , 'slug' => '']);
        $subcategory9 = factory(Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Women' , 'slug' => 'women']);



        // factory(Product::class, 50)->create();
        // for ($i=1; $i <= 30; $i++) {
        //     Product::create([
        //         'category_id'    => Arr::random(Category::inRandomOrder()->pluck('id')->toArray()),
        //         'subcategory_id' => Arr::random(Subcategory::inRandomOrder()->pluck('id')->toArray()),
        //         'imageUrl'       => Arr::random([
        //             'products/man1.jpg',
        //             'products/man2.jpg',
        //             'products/man3.jpg',
        //             'products/man4.jpg',
        //             'products/man5.jpg',
        //             'products/man6.jpg',
        //             'products/man.jpg',
        //             'products/baby.jpg',
        //             'products/baby1.jpg',
        //             'products/baby2.jpg',
        //             'products/woman.jpg',
        //             'products/woman1.jpg',
        //             'products/woman2.jpg',
        //             'products/woman3.jpg',
        //             'products/woman4.jpg',
        //             'products/woman5.jpg',
        //             'products/woman6.jpg',
        //             'products/woman7.jpg',
        //             'products/woman8.jpg',
        //             'products/woman9.jpg',
        //             'products/woman10.jpg',
        //             'products/woman11.jpg',
        //             'products/woman12.jpg'
        //         ]),
        //         'name'           => $i .'Shoe',
        //         'average_rating' => Arr::random([1,2,3,4,5]),
        //         'slug'           => $i .'-Shoe',
        //         'price'          => 
        //             Arr::random([99, 199, 299, 399, 499, 999, 1299, 2499]),
        //         'qty'            => Arr::random([0, 2, 4, 1, 5]),
        //         'featured'       => Arr::random([true, false])
        //     ]);
        // }


        for ($i=1; $i < 40; $i++) {

            $category      = Arr::random(Category::inRandomOrder()->pluck('id')->toArray());
            $subcategory   = Arr::random(Subcategory::inRandomOrder()->pluck('id')->toArray());
            $url    =  Arr::random([
                    'products/man1.jpg',
                    'products/man2.jpg',
                    'products/man3.jpg',
                    'products/man4.jpg',
                    'products/man5.jpg',
                    'products/man6.jpg',
                    'products/man.jpg',
                    'products/baby.jpg',
                    'products/baby1.jpg',
                    'products/baby2.jpg',
                    'products/woman.jpg',
                    'products/woman1.jpg',
                    'products/woman2.jpg',
                    'products/woman3.jpg',
                    'products/woman4.jpg',
                    'products/woman5.jpg',
                    'products/woman6.jpg',
                    'products/woman7.jpg',
                    'products/woman8.jpg',
                    'products/woman9.jpg',
                    'products/woman10.jpg',
                    'products/woman11.jpg',
                    'products/woman12.jpg'
                ]);

            $faker = \Faker\Factory::create();

            Product::create([
                'category_id'    => $category1,
                'subcategory_id' => $subcategory,
                'imageUrl'       => $url,
                'name'           => $faker->title,
                'average_rating' => $faker->numberBetween(1, 5),
                'slug'           => $faker->title . '-shoe',
                'price'          => $faker->unique(true)->numberBetween(100, 500),
                'qty'            => $faker->unique(true)->numberBetween(1, 30),
                'description'    => $faker->text(200),
                'created_at'     => Arr::random([1,2,3,5,8, 10, 20]),
                'featured'       => Arr::random([true, false])
            ]);
        }

        // factory(ProductImages::class, 100)->create();
        for ($i=1; $i < 70; $i++) {

            $product      = Arr::random(Product::inRandomOrder()->pluck('id')->toArray());
            $url    =  Arr::random([
                    'products/man1.jpg',
                    'products/man2.jpg',
                    'products/man3.jpg',
                    'products/man4.jpg',
                    'products/man5.jpg',
                    'products/man6.jpg',
                    'products/man.jpg',
                    'products/baby.jpg',
                    'products/baby1.jpg',
                    'products/baby2.jpg',
                    'products/woman.jpg',
                    'products/woman1.jpg',
                    'products/woman2.jpg',
                    'products/woman3.jpg',
                    'products/woman4.jpg',
                    'products/woman5.jpg',
                    'products/woman6.jpg',
                    'products/woman7.jpg',
                    'products/woman8.jpg',
                    'products/woman9.jpg',
                    'products/woman10.jpg',
                    'products/woman11.jpg',
                    'products/woman12.jpg'
                ]);

            $faker = \Faker\Factory::create();
            ProductImages::create([
                'product_id' => $product,
                'imageUrl'   => $url,
                'thumbnail'  => $url
            ]);
        }

        factory(Order::class, 50)->create();
        factory(Order_Item::class, 100)->create();

        factory(Review::class, 100)->create();

        // Coupon::create([
        //     'code' => 'WOMEN20', 'percent' => 20,'expires_on' => \Carbon\Carbon::yesterday()
        // ]);

        factory(Coupon::class)->create(['code' => 'WOMEN20', 'percent' => 20,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(Coupon::class)->create(['code' => 'CODE1', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(Coupon::class)->create(['code' => 'CODE2', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(Coupon::class)->create([ 'code' => 'CODE3', 'percent' => 4,'expires_on' => \Carbon\Carbon::now()]);
        factory(Coupon::class)->create(['code' => 'CODE4', 'percent' => 3,'expires_on' => \Carbon\Carbon::now()->addDays(10)]);
        factory(Coupon::class)->create([ 'code' => 'CODE5', 'percent' => 5,'expires_on' => \Carbon\Carbon::now()->addDays(12)]);
        
        
        
        // Select random entries to be featured
        Product::whereIn('id', [1, 3, 6,8,11,22,29, 30,33, 21,99])->update(['featured' => true]);
    }
}
