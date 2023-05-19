<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavedItemRequest;
use App\Http\Requests\UpdateSavedItemRequest;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\SavedItem;

class SavedItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $savedItems = $user->savedItems()->get();

        return view('savedItems.saved-items', compact('savedItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSavedItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Recipe $recipe)
    {
        auth()->user()->savedItems()->create(['recipe_id' => $recipe->id]);

        return redirect()->back()->with('msg', 'Item Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SavedItem  $savedItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $user = auth()->user();
        $user->savedItems()->where('recipe_id',$recipe->id)->delete();

        return redirect()->back()->with('success', 'Recipe removed from saved items.');
    }
}
