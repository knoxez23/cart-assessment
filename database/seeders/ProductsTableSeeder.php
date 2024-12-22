<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'car_name' => 'Car 1',
                'image' => 'images/car_1.jpg',
                'description' => 'This is a description for Car 1.',
                'price' => 10000.00,
            ],
            [
                'car_name' => 'Car 2',
                'image' => 'images/car_2.jpg',
                'description' => 'This is a description for Car 2.',
                'price' => 15000.00,
            ],
            [
                'car_name' => 'Car 3',
                'image' => 'images/car_3.jpg',
                'description' => 'This is a description for Car 3.',
                'price' => 20000.00,
            ],
        ]);
    }
}
