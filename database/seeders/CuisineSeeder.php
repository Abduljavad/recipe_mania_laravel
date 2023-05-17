<?php

namespace Database\Seeders;

use App\Models\Cuisine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cuisines = [
            ['name' => 'Italian cuisine', 'value' => 'italian'],
            ['name' => 'Chinese cuisine', 'value' => 'chinese'],
            ['name' => 'Mexican cuisine', 'value' => 'mexican'],
            ['name' => 'Indian cuisine', 'value' => 'indian'],
            ['name' => 'Japanese cuisine', 'value' => 'japanese'],
        ];

        Cuisine::insert($cuisines);
    }
}
