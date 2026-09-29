<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompensationRuleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('compensation_rules')->insert([
            [
                'category_id' => 1, // Wallet
                'min_amount' => 0,
                'max_amount' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2, // Cellphone
                'min_amount' => 0,
                'max_amount' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3, // Laptop
                'min_amount' => 0,
                'max_amount' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 4, // School ID
                'min_amount' => 0,
                'max_amount' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 5, // Keys
                'min_amount' => 0,
                'max_amount' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 6, // Bag
                'min_amount' => 0,
                'max_amount' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 7, // Books
                'min_amount' => 0,
                'max_amount' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 8, // Clothing
                'min_amount' => 0,
                'max_amount' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 9, // Jewelry
                'min_amount' => 0,
                'max_amount' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 10, // Electronic Device
                'min_amount' => 0,
                'max_amount' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}