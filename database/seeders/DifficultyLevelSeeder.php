<?php

namespace Database\Seeders;

use App\Models\DifficultyLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultyLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $difficultyLevels = [
            ['name' => 'Beginner'],
            ['name' => 'Easy'],
            ['name' => 'Intermediate'],
            ['name' => 'Advanced'],
            ['name' => 'Expert'],
        ];

        DifficultyLevel::insert($difficultyLevels);
    }
}
