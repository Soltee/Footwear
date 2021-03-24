<?php
namespace Database\Seeders;

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

        // Heroku
        // \DB::table('coupons')->insert([
        //     ['code' => 'SHOES20', 'percent' => 20,'expires_on' => \Carbon\Carbon::yesterday()],
        // ]);
        // \DB::table('categories')->insert([
        //     ['name' => 'Brands', 'slug' => 'brands' ],
        //     ['name' => 'Type', 'slug' => 'type' ]
        // ]);
        // \DB::table('subcategories')->insert([
        //     ['category_id' => 1, 'name' => 'Featured' , 'slug' => 'featured'],
        //     ['category_id' => 1, 'name' => 'Adidas' , 'slug' => 'adidas'],
        //     ['category_id' => 1, 'name' => 'Converse' , 'slug' => 'converse'],
        //     ['category_id' => 1, 'name' => 'DC' , 'slug' => 'dc'],

        //     ['category_id' => 1, 'name' => 'Nike' , 'slug' => 'nike'],
        //     ['category_id' => 2, 'name' => 'Baby' , 'slug' => 'baby'],
        //     ['category_id' => 2, 'name' => 'Children' , 'slug' => 'children'],
        //     ['category_id' => 2, 'name' => 'Men' , 'slug' => 'men'],
        //     ['category_id' => 2, 'name' => 'Women' , 'slug' => 'women']
        // ]);
        for ($i=1; $i < 40; $i++) {
            $category      = Illuminate\Support\Arr::random(App\Category::inRandomOrder()->pluck('id')->toArray());
            $subcategory   = Illuminate\Support\Arr::random(App\Subcategory::inRandomOrder()->pluck('id')->toArray());
            $url    =  Illuminate\Support\Arr::random([
                    'storage/products/man1.jpg',
                    'storage/products/man2.jpg',
                    'storage/products/man3.jpg',
                    'storage/products/man4.jpg',
                    'storage/products/man5.jpg',
                    'storage/products/man6.jpg',
                    'storage/products/man.jpg',
                    'storage/products/baby.jpg',
                    'storage/products/baby1.jpg',
                    'storage/products/baby2.jpg',
                    'storage/products/woman.jpg',
                    'storage/products/woman1.jpg',
                    'storage/products/woman2.jpg',
                    'storage/products/woman3.jpg',
                    'storage/products/woman4.jpg',
                    'storage/products/woman5.jpg',
                    'storage/products/woman6.jpg',
                    'storage/products/woman7.jpg',
                    'storage/products/woman8.jpg',
                    'storage/products/woman9.jpg',
                    'storage/products/woman10.jpg',
                    'storage/products/woman11.jpg',
                    'storage/products/woman12.jpg'
                ]);


            $name = Illuminate\Support\Str::random(5);
            $price = rand(1,1000);
            $qty = rand(1,30);
            $rating = rand(1,5);
            $created  = rand(1,30);
            $featured = Illuminate\Support\Arr::random([true, false]);
            App\Product::create([
                'category_id'    => $category,
                'subcategory_id' => $subcategory,
                'imageUrl'       => $url,
                'name'           => $name,
                'average_rating' => $rating,
                'slug'           => $name . '-shoe',
                'price'          => $price,
                'qty'            => $qty,
                'created_at'     => $created,
                'featured'       => true
            ]);
        }

        $ids = [1,2,56,78,90,23,4,90,88,112,113,116];
        Product::whereIn('id', $ids)->update(['featured' => true]);

        // App\Product::findOrfail([1,2,56,78,90,23,4,90,88,112,113,116])->update(['featured' , 1]);

        for ($i=1; $i < 20; $i++) {
            $category      = Illuminate\Support\Arr::random(App\Category::inRandomOrder()->pluck('id')->toArray());
            $subcategory   = Illuminate\Support\Arr::random(App\Subcategory::inRandomOrder()->pluck('id')->toArray());
            $url    =  Illuminate\Support\Arr::random([
                    'storage/products/man1.jpg',
                    'storage/products/man2.jpg',
                    'storage/products/man3.jpg',
                    'storage/products/man4.jpg',
                    'storage/products/man5.jpg',
                    'storage/products/man6.jpg',
                    'storage/products/man.jpg',
                    'storage/products/baby.jpg',
                    'storage/products/baby1.jpg',
                    'storage/products/baby2.jpg',
                    'storage/products/woman.jpg',
                    'storage/products/woman1.jpg',
                    'storage/products/woman2.jpg',
                    'storage/products/woman3.jpg',
                    'storage/products/woman4.jpg',
                    'storage/products/woman5.jpg',
                    'storage/products/woman6.jpg',
                    'storage/products/woman7.jpg',
                    'storage/products/woman8.jpg',
                    'storage/products/woman9.jpg',
                    'storage/products/woman10.jpg',
                    'storage/products/woman11.jpg',
                    'storage/products/woman12.jpg'
                ]);


            $name = Illuminate\Support\Str::random(5);
            $price = rand(1,1000);
            $qty = rand(1,30);
            $rating = rand(1,5);
            $created  = rand(1,30);

            App\Product::create([
                'category_id'    => $category,
                'subcategory_id' => $subcategory,
                'imageUrl'       => $url,
                'name'           => $name,
                'average_rating' => $rating,
                'slug'           => $name . '-shoe',
                'price'          => $price,
                'qty'            => $qty,
                'created_at'     => $created,
                'featured'       => 1
            ]);
        }


        factory(Customer::class)->create(['last_name' => 'Nari','first_name' => 'role', 'email'=>'customer@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);

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



        factory(Product::class, 50)->create();

        // factory(ProductImages::class, 100)->create();
        // for ($i=1; $i < 120; $i++) {

        //     $product      = Illuminate\Support\Arr::random(Product::inRandomOrder()->pluck('id')->toArray());
        //     $url    =  Illuminate\Support\Arr::random([
        //             'storage/products/man1.jpg',
        //             'storage/products/man2.jpg',
        //             'storage/products/man3.jpg',
        //             'storage/products/man4.jpg',
        //             'storage/products/man5.jpg',
        //             'storage/products/man6.jpg',
        //             'storage/products/man.jpg',
        //             'storage/products/baby.jpg',
        //             'storage/products/baby1.jpg',
        //             'storage/products/baby2.jpg',
        //             'storage/products/woman.jpg',
        //             'storage/products/woman1.jpg',
        //             'storage/products/woman2.jpg',
        //             'storage/products/woman3.jpg',
        //             'storage/products/woman4.jpg',
        //             'storage/products/woman5.jpg',
        //             'storage/products/woman6.jpg',
        //             'storage/products/woman7.jpg',
        //             'storage/products/woman8.jpg',
        //             'storage/products/woman9.jpg',
        //             'storage/products/woman10.jpg',
        //             'storage/products/woman11.jpg',
        //             'storage/products/woman12.jpg'
        //         ]);

        //     $products    =  App\Product::inRandomOrder()->pluck('id')->toArray();
        //     $product     = Illuminate\Support\Arr::random($products);

        //         $image    =  Illuminate\Support\Arr::random([
        //             'man1.jpg',
        //             'man2.jpg',
        //             'man3.jpg',
        //             'man4.jpg',
        //             'man5.jpg',
        //             'man6.jpg',
        //             'man.jpg',
        //             'baby.jpg',
        //             'baby1.jpg',
        //             'baby2.jpg',
        //             'woman.jpg',
        //             'woman1.jpg',
        //             'woman2.jpg',
        //             'woman3.jpg',
        //             'woman4.jpg',
        //             'woman5.jpg',
        //             'woman6.jpg',
        //             'woman7.jpg',
        //             'woman8.jpg',
        //             'woman9.jpg',
        //             'woman10.jpg',
        //             'woman11.jpg',
        //             'woman12.jpg'
        //         ]);


        //     App\ProductImages::create([
        //         'product_id' => $product,
        //         'imageUrl'   => $url,
        //         'thumbnail'  => $image
        //     ]);
        // }

        factory(Order::class, 50)->create();
        factory(Order_Item::class, 100)->create();

        factory(Review::class, 100)->create();

        factory(Coupon::class)->create(['code' => 'SHOES20', 'percent' => 20,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(Coupon::class)->create(['code' => 'CODE1', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(Coupon::class)->create(['code' => 'CODE2', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(Coupon::class)->create([ 'code' => 'CODE3', 'percent' => 4,'expires_on' => \Carbon\Carbon::now()]);
        factory(Coupon::class)->create(['code' => 'CODE4', 'percent' => 3,'expires_on' => \Carbon\Carbon::now()->addDays(10)]);
        factory(Coupon::class)->create([ 'code' => 'CODE5', 'percent' => 5,'expires_on' => \Carbon\Carbon::now()->addDays(12)]);
        
        
        
        // Select random entries to be featured
        Product::whereIn('id', [1, 3, 6,8,11,22,29, 30,33, 21,99])->update(['featured' => true]);
    }
}
