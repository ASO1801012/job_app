<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '河津翔太',
            'email' => '9946sho@gmail.com',
            'password' => bcrypt('2051sho9946'),
        ]);
    }
}
