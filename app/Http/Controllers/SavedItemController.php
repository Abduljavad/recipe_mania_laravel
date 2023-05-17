<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSavedItemRequest;
use App\Http\Requests\UpdateSavedItemRequest;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\SavedItem;

class SavedItemController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Models\SavedItem  $savedItem
     * @return \Illuminate\Http\Response
     */
    public function show(SavedItem $savedItem)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SavedItem  $savedItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SavedItem $savedItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSavedItemRequest  $request
     * @param  \App\Models\SavedItem  $savedItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSavedItemRequest $request, SavedItem $savedItem)
    {
        //
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
