<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $draftedRecipe = Recipe::create([
            'user_id' => 1,
            'name' => 'chakka upperi',
            'status' => 'drafted',
            'instructions' => 'Take the chakka Fry the chakka',
            'img' => 'https://coconutbasket.com/wp-content/uploads/2020/11/jackfruit-chips.jpeg',
            'category_id' => 1,
            'cuisine_id' => 1,
            'difficulty_level_id' => 1
        ]);
        $draftedRecipe->ingredients()->createMany([
            ['name' => 'JackFruit', 'quantity' => '1kg'],
            ['name' => 'CoconutOil', 'quantity' => '1/2 litre']
        ]);
        $publishedRecipe =  Recipe::create([
            'user_id' => 1,
            'name' => 'kappa upperi',
            'status' => 'published',
            'instructions' => 'Take the kappa Fry the chakka',
            'img' => 'https://coconutbasket.com/wp-content/uploads/2020/11/jackfruit-chips.jpeg',
            'category_id' => 2,
            'cuisine_id' => 2,
            'difficulty_level_id' => 2
        ]);

        $publishedRecipe->ingredients()->createMany([
            ['name' => 'Tapioca', 'quantity' => '1kg'],
            ['name' => 'CoconutOil', 'quantity' => '1/2 litre']
        ]);

        $RejectedRecipe =  Recipe::create([
            'user_id' => 1,
            'name' => 'manga upperi',
            'status' => 'rejected',
            'instructions' => 'Take the manga Fry the chakka',
            'img' => 'https://coconutbasket.com/wp-content/uploads/2020/11/jackfruit-chips.jpeg',
            'category_id' => 3,
            'cuisine_id' => 3,
            'difficulty_level_id' => 3
        ]);

        $RejectedRecipe->ingredients()->createMany([
            ['name' => 'Mango', 'quantity' => '1kg'],
            ['name' => 'CoconutOil', 'quantity' => '1/2 litre']
        ]);
    }
}
