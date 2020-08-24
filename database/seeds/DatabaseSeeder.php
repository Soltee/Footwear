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
        factory(App\Administrator::class)->create(['avatar'=>'1.jpg', 'last_name' => 'Munu','first_name' => 'Admin', 'email'=>'admin@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);
        factory(App\Customer::class)->create(['last_name' => 'Nari','first_name' => 'role', 'email'=>'customer@example.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => Str::random()]);
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



        factory(App\Product::class, 50)->create();
        factory(App\ProductImages::class, 100)->create();

        factory(App\Orders::class, 50)->create();
        factory(App\Order_Items::class, 100)->create();

        factory(App\Review::class, 100)->create();

        factory(\App\Coupon::class)->create(['code' => 'CODE1', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(\App\Coupon::class)->create(['code' => 'CODE2', 'percent' => 2,'expires_on' => \Carbon\Carbon::yesterday()]);
        factory(\App\Coupon::class)->create([ 'code' => 'CODE3', 'percent' => 4,'expires_on' => \Carbon\Carbon::now()]);
        factory(\App\Coupon::class)->create(['code' => 'CODE4', 'percent' => 3,'expires_on' => \Carbon\Carbon::now()->addDays(10)]);
        factory(\App\Coupon::class)->create([ 'code' => 'CODE5', 'percent' => 5,'expires_on' => \Carbon\Carbon::now()->addDays(12)]);
        
        // Select random entries to be featured
        // Products::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53,61, 69, 73, 80])->update(['featured' => true]);
    }
}
