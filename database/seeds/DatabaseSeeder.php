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
        factory(App\Administrator::class , 2)->create();

        factory(App\Categories::class)->create(['name' => 'Brands' ]);
        factory(App\Categories::class)->create(['name' => 'Type' ]);

        factory(App\Subcategories::class)->create(['category_id' => 1, 'name' => 'featured' ]);
        factory(App\Subcategories::class)->create(['category_id' => 1, 'name' => 'Adidas' ]);
        factory(App\Subcategories::class)->create(['category_id' => 1, 'name' => 'Converse' ]);
        factory(App\Subcategories::class)->create(['category_id' => 1, 'name' => 'DC' ]);
        factory(App\Subcategories::class)->create(['category_id' => 1, 'name' => 'Nike' ]);
        factory(App\Subcategories::class)->create(['category_id' => 2, 'name' => 'Baby' ]);
        factory(App\Subcategories::class)->create(['category_id' => 2, 'name' => 'Children' ]);
        factory(App\Subcategories::class)->create(['category_id' => 2, 'name' => 'Men' ]);
        factory(App\Subcategories::class)->create(['category_id' => 2, 'name' => 'Women' ]);

        for ($i=1; $i <= 2; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 1,
                'subcategory_id' => 1,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }
       
        for ($i = 3; $i <= 4; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 2,
                'subcategory_id' => 2,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }

        for ($i=5; $i <= 6; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 2,
                'subcategory_id' => 3,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }
       
        for ($i = 7; $i <= 8; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 1,
                'subcategory_id' => 4,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }

        for ($i=9; $i <= 10; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 1,
                'subcategory_id' => 5,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }
       
        for ($i = 11; $i <= 12; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 2,
                'subcategory_id' => 6,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }


        for ($i=13; $i <= 14; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 2,
                'subcategory_id' => 7,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }
       
        for ($i = 15; $i <= 16; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 1,
                'subcategory_id' => 8,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }

        for ($i=17; $i <= 18; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 1,
                'subcategory_id' => 2,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }
       
        for ($i = 19; $i <= 20; $i++) {
            App\Products::create([
                'name' => 'Shoe '.$i,
                'category_id' => 2,
                'subcategory_id' => 3,
                'price' => rand(149999, 249999),
                'qty' => rand(0, 100),
                'imageUrl' => $i.'.jpg',
            ]);
        }
    
        
        
        // Select random entries to be featured
        // Products::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53,61, 69, 73, 80])->update(['featured' => true]);
    }
}
