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
    	factory(App\Customer::class , 20)->create();
        factory(App\Administrator::class , 2)->create();
        factory(App\Categories::class , 3)->create();
        // $this->call(UsersTableSeeder::class);
        factory(App\Products::class, 30)->create();
    }
}
