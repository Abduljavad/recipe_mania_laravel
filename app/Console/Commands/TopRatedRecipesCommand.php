<?php

namespace App\Console\Commands;

use App\Models\Recipe;
use App\Models\TopRatedRecipe;
use Illuminate\Console\Command;

class TopRatedRecipesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recipes:top-rated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve the top-rated recipes and store them in a table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $topRatedRecipes = Recipe::with('rating', function ($rating) {
            $rating->orderByDesc('rating');
        })
            ->take(10)
            ->get();

        foreach ($topRatedRecipes as $recipe) {
            TopRatedRecipe::create([
                'recipe_id' => $recipe,
                'rating' => $recipe->avgRating($recipe)
            ]);
        }
    }
}
