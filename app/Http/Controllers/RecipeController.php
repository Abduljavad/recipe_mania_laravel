<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\DifficultyLevel;
use App\Models\Recipe;
use App\Models\User;
use App\Services\RecipeServices;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public $recipeServices;

    public function __construct(RecipeServices $recipeServices)
    {
        $this->middleware('auth')->except('index','show');
        $this->recipeServices = $recipeServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipe.index', compact('recipes'));
    }

    public function personalRecipe()
    {
        $recipes = auth()->user()->recipes;
        return view('recipe.personal-recipes', compact('recipes'));
    }

    public function create()
    {
        $categories = Category::all();
        $cuisines = Cuisine::all();
        $difficultyLevels = DifficultyLevel::all();
        return view('recipe.recipe-create', compact('categories', 'cuisines', 'difficultyLevels'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('images', 'public');
            $url = Storage::url($path);
            $data['img'] = asset($url);
        }
        $data['status'] = 'drafted';
        $user = User::findOrFail(auth()->user()->id);
        $recipe = $user->recipes()->create($data);

        $ingredientNames = $request->ingredient_name;
        $ingredientQuantities = $request->ingredient_quantity;

        foreach ($ingredientNames as $index => $name) {
            $quantity = $ingredientQuantities[$index];
            $ingredient = array(
                'name' => $name,
                'quantity' => $quantity
            );

            $ingredients[] = $ingredient;
        }
        $recipe->ingredients()->createMany($ingredients);

        return redirect()->route('home')->with('msg', 'created successfully');
    }
    public function publish(Recipe $recipe)
    {
        $recipe->update(['status' => 'pending']);
        return redirect()->back()->with('msg', 'Recipe Published');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $categories = Category::all();
        $avgRating = $this->recipeServices->calculateAvgRating($recipe);
        return view('recipe.recipe-show', compact('recipe', 'categories', 'avgRating'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecipeRequest  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $data = $request->validated();
        $recipe->update($data);

        return view('index.show', compact('recipe'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('recipe.index')->with('msg', 'Recipe Deleted Successfully');
    }

    
}
