<?php

use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock')->insert([
           ['name' => 'Hà Nội'],
           ['name' => 'Hải Phòng'],
           ['name' => 'Bắc Ninh'],
           ['name' => 'Hà Nam']
        ]);
    }
}
