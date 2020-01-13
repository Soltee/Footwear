<?php

use Illuminate\Database\Seeder;

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
    	factory(App\Customer::class , 20)->create();
        factory(App\Administrator::class)->create(['avatar'=>'admin.jpg', 'last_name' => 'Munu','first_name' => 'Admin', 'email'=>'admin@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);
        factory(App\Administrator::class)->create(['avatar'=>'role.jpg', 'last_name' => 'Nari','first_name' => 'role', 'email'=>'role@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);
        factory(App\Administrator::class)->create();

        $category1 = factory(App\Category::class)->create(['name' => 'Brands', 'slug' => 'brands' ]);
        $category2 = factory(App\Category::class)->create(['name' => 'Type', 'slug' => 'type' ]);

        $subcategory1 = factory(App\Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'featured' , 'slug' => 'featured']);
        $subcategory2 = factory(App\Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Adidas' , 'slug' => 'adidas']);
        $subcategory3 = factory(App\Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Converse' , 'slug' => 'converse']);
        $subcategory4 = factory(App\Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'DC' , 'slug' => 'dc']);
        $subcategory5 = factory(App\Subcategory::class)->create(['category_id' => $category1->id, 'name' => 'Nike' , 'slug' => 'nike']);
        $subcategory6 = factory(App\Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Baby' , 'slug' => 'baby']);
        $subcategory7 = factory(App\Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Children' , 'slug' => 'children']);
        $subcategory8 = factory(App\Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Men' , 'slug' => '']);
        $subcategory9 = factory(App\Subcategory::class)->create(['category_id' => $category2->id, 'name' => 'Women' , 'slug' => 'women']);

        for ($i=1; $i <= 2; $i++) {
            $h1 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category1,
                'subcategory_id' => $subcategory1->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'created_at' => today()->subDays(1)
            ]);
        }
       
        for ($i = 3; $i <= 4; $i++) {
            $h2 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category2->id,
                'subcategory_id' => $subcategory2->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'created_at' => today()->subDays(1)
            ]);
        }

        for ($i=5; $i <= 6; $i++) {
            $h3 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category1->id,
                'subcategory_id' => $subcategory7->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'featured' => true,
                'created_at' => today()->subDays(1)
            ]);
        }
       
        for ($i = 7; $i <= 8; $i++) {
            $h4 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category2->id,
                'subcategory_id' => $subcategory3->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'created_at' => today()->subDays(2)
            ]);
        }

        for ($i=9; $i <= 10; $i++) {
            $h5 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category1->id,
                'subcategory_id' => $subcategory7->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'featured' => true,
                'created_at' => today()->subDays(2)
            ]);
        }
       
        for ($i = 11; $i <= 12; $i++) {
            $h6 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category2->id,
                'subcategory_id' => $subcategory9->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'created_at' => today()->subDays(10)
            ]);
        }


        for ($i=13; $i <= 14; $i++) {
            $h7 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category1->id,
                'subcategory_id' => $subcategory5->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'created_at' => today()->subDays(10)
            ]);
        }
       
        for ($i = 15; $i <= 16; $i++) {
            $h8 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category2->id,
                'subcategory_id' => $subcategory2->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'featured' => true,
                'created_at' => today()->subDays(3)
            ]);
        }

        for ($i=17; $i <= 18; $i++) {
            $h9 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category1->id,
                'subcategory_id' => $subcategory1->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'created_at' => today()->subDays(3)
            ]);
        }
       
        for ($i = 19; $i <= 20; $i++) {
            $h10 = App\Product::create([
                'name' => 'Shoe '. $i,
                'slug' => 'Shoe-'. $i,
                'category_id' => $category1->id,
                'subcategory_id' => $subcategory9->id,
                'price' => rand(1, 5),
                'qty' => rand(0, 100),
                'imageUrl' => '/products/'. $i.'.jpg',
                'featured' => true,
                'created_at' => today()
            ]);
        }

        //ProductImages
        for ($i = 1; $i <= 3; $i++) {
            App\ProductImages::create([
                'product_id' => $h1->id,
                'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 4; $i <= 5; $i++) {
            App\ProductImages::create([
                'product_id' => $h2->id,
                              'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 6; $i <= 8; $i++) {
            App\ProductImages::create([
                'product_id' => $h3->id,
                              'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 9; $i <= 11; $i++) {
            App\ProductImages::create([
                'product_id' => $h4->id,
                              'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 12; $i <= 15; $i++) {
            App\ProductImages::create([
                'product_id' => $h5->id,
                              'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 16; $i <= 17; $i++) {
            App\ProductImages::create([
                'product_id' => $h10->id,
                              'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 18; $i <= 20; $i++) {
            App\ProductImages::create([
                'product_id' => $h6->id,
                              'imageUrl' => '/products/'. $i.'.jpg',
                'thumbnail' => '/products/'. $i.'.jpg',
            ]);
        }

        for ($i = 21; $i <= 23; $i++) {
            App\ProductImages::create([
                'product_id' => $h2->id,
                              'imageUrl' => '/products/1.jpg',
                'thumbnail' => '/products/1.jpg',
            ]);
        }


        for ($i = 24; $i <= 25; $i++) {
            App\ProductImages::create([
                'product_id' => $h7->id,
                              'imageUrl' => '/products/2.jpg',
                'thumbnail' => '/products/2.jpg',
            ]);
        }

        //
        for ($i = 26; $i <= 27; $i++) {
            App\ProductImages::create([
                'product_id' => $h2->id,
                               'imageUrl' => '/products/3.jpg',
                'thumbnail' => '/products/3.jpg',
            ]);
        }

        for ($i = 28; $i <= 29; $i++) {
            App\ProductImages::create([
                'product_id' => $h8->id,
                               'imageUrl' => '/products/4.jpg',
                'thumbnail' => '/products/4.jpg',
            ]);
        }

        for ($i = 30; $i <= 32; $i++) {
            App\ProductImages::create([
                'product_id' => $h9->id,
                               'imageUrl' => '/products/5.jpg',
                'thumbnail' => '/products/5.jpg',
            ]);
        }

        for ($i = 33; $i <= 34; $i++) {
            App\ProductImages::create([
                'product_id' => $h8->id,
                               'imageUrl' => '/products/6.jpg',
                'thumbnail' => '/products/6.jpg',
            ]);
        }

        for ($i = 35; $i <= 36; $i++) {
            App\ProductImages::create([
                'product_id' => $h8->id,
                               'imageUrl' => '/products/7.jpg',
                'thumbnail' => '/products/7.jpg',
            ]);
        }

        for ($i = 37; $i <= 38; $i++) {
            App\ProductImages::create([
                'product_id' => $h8->id,
                               'imageUrl' => '/products/8.jpg',
                'thumbnail' => '/products/8.jpg',
            ]);
        }

        for ($i = 39; $i <= 40; $i++) {
            App\ProductImages::create([
                'product_id' => $h8->id,
                               'imageUrl' => '/products/9.jpg',
                'thumbnail' => '/products/9.jpg',
            ]);
        }

        for ($i = 41; $i <= 43; $i++) {
            App\ProductImages::create([
                'product_id' => $h10->id,
                               'imageUrl' => '/products/10.jpg',
                'thumbnail' => '/products/10.jpg',
            ]);
        }


        for ($i = 44; $i <= 46; $i++) {
            App\ProductImages::create([
                'product_id' => $h8->id,
                               'imageUrl' => '/products/11.jpg',
                'thumbnail' => '/products/11.jpg',
            ]);
        }


        for ($i = 47; $i <= 49; $i++) {
            App\ProductImages::create([
                'product_id' => $h9->id,
                               'imageUrl' => '/products/14.jpg',
                'thumbnail' => '/products/14.jpg',
            ]);
        }


        for ($i = 50; $i <= 52; $i++) {
            App\ProductImages::create([
                'product_id' => $h10->id,
                               'imageUrl' => '/products/19.jpg',
                'thumbnail' => '/products/19.jpg',
            ]);
        }

        factory(App\Orders::class, 50)->create();
        factory(App\Order_Items::class, 100)->create();

    
        factory(\App\Coupon::class)->create(['code' => 'CODE1', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(\App\Coupon::class)->create(['code' => 'CODE2', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(\App\Coupon::class)->create([ 'code' => 'CODE3', 'percent' => 4,'expires_on' => \Carbon\Carbon::now()]);
        factory(\App\Coupon::class)->create(['code' => 'CODE4', 'percent' => 3,'expires_on' => \Carbon\Carbon::now()->addDays(10)]);
        factory(\App\Coupon::class)->create([ 'code' => 'CODE5', 'percent' => 5,'expires_on' => \Carbon\Carbon::now()->addDays(12)]);
        
        // Select random entries to be featured
        // Products::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53,61, 69, 73, 80])->update(['featured' => true]);
    }
}
