<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cuisine;
use App\Models\DifficultyLevel;
use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        $recipes = Recipe::with('difficultyLevel')
            ->byCategory($request)
            ->byCuisine($request)
            ->byName($request)
            ->byDifficulty($request)
            ->get();

        $categories = Category::all();
        $cuisines = Cuisine::all();
        $difficultyLevels = DifficultyLevel::all();
        return view('home.index', compact('categories', 'cuisines', 'difficultyLevels', 'recipes'));
    }
}
