<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
      Product::create([
           'category_id'=>'1',
           'title'=>'nokia',
           'slug'=>'nokia-is-a-good-phone',
           'description'=>'nokia is a good phone',
           'price'=>'125',
        

      ]);
      
    }
}
