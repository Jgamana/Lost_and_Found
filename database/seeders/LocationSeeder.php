<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        \DB::table('locations')->insert([
            ['name' => 'Classroom'],
            ['name' => 'Library'],
            ['name' => 'Cafeteria'],
            ['name' => 'Gymnasium'],
            ['name' => 'Office'],
            ['name' => 'Laboratory'],
            ['name' => 'Hallway'],
            ['name' => 'Comfort Room'],
        ]);
    }
}