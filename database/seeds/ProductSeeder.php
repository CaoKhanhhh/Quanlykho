<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $product_list =10;
        for($i=0;$i<$product_list;$i++){
            DB::table('product')->insert([
                'name' => $faker->name,
                'image'=> $faker->imageUrl($width=84,$height=84,'technics'),
                'price'=> rand(10,1000),
            ]);
        }
    }
}
