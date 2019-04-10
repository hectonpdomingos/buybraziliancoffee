<?php


use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => Str::random(10),
            'coffeetype' => Str::random(10),
            'coffeetype' => Str::random(10),
            'password' => bcrypt('secret'),
        ]);
    }
}
