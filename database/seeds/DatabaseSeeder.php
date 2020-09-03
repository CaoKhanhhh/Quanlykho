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
         $this->call(UserSeeder::class);
         $this->call(Type_billSeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(StockSeeder::class);
    }
}
