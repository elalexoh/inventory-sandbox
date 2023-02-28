<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name'          => Str::random(10),
            'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus labore natus reiciendis suscipit harum sint ut cumque nam minima officiis culpa nisi dicta perferendis qui illo, facere ducimus sapiente maxime!',
            'price'         => 50.00,
            'store_id'      => 1,
        ]);
        DB::table('products')->insert([
            'name'          => Str::random(10),
            'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus labore natus reiciendis suscipit harum sint ut cumque nam minima officiis culpa nisi dicta perferendis qui illo, facere ducimus sapiente maxime!',
            'price'         => 25.00,
            'store_id'      => 1,
        ]);
        DB::table('products')->insert([
            'name'          => Str::random(10),
            'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus labore natus reiciendis suscipit harum sint ut cumque nam minima officiis culpa nisi dicta perferendis qui illo, facere ducimus sapiente maxime!',
            'price'         => 45.00,
            'store_id'      => 1,
        ]);
    }
}
