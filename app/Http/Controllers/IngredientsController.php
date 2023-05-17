<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredientsRequest;
use App\Http\Requests\UpdateIngredientsRequest;
use App\Models\Ingredients;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreIngredientsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngredientsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredients $ingredients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredients $ingredients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIngredientsRequest  $request
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngredientsRequest $request, Ingredients $ingredients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredients $ingredients)
    {
        //
    }
}
