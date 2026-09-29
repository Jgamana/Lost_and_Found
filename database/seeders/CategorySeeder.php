<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Wallet'],
            ['name' => 'Cellphone'],
            ['name' => 'Laptop'],
            ['name' => 'School ID'],
            ['name' => 'Keys'],
            ['name' => 'Bag'],
            ['name' => 'Books'],
            ['name' => 'Clothing'],
            ['name' => 'Jewelry'],
            ['name' => 'Electronic Device'],
        ]);
    }
}