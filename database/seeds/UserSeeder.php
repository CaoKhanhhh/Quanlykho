<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'root',
            'password' => Hash::make('rootpass'),
            'email' => 'duckhanhcao1@gmail.com',
            'name'  => 'admin',
            'role' => 1,
        ]);
    }
}
