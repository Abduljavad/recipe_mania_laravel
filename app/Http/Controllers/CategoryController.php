<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Cuisine;
use App\Models\DifficultyLevel;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return redirect('/')->with('msg', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $recipes = Recipe::where('category_id',$category->id)->get();
        $categories = Category::all();
        $cuisines = Cuisine::all();
        $difficultyLevels = DifficultyLevel::all();
        return view('home.index', compact('categories', 'cuisines', 'difficultyLevels', 'recipes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return view('categories.show', compact([$category => 'category']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return view('categories.index', compact([$category => 'category']));
    }
}
