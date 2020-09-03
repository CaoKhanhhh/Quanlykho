<?php

use Illuminate\Database\Seeder;

class Type_billSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_bill=[
            ['name'=>'import'],
            ['name'=>'export']
        ];
        DB::table('type_bill')->insert($type_bill);
    }
}
