<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Rating;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Rating::class, 'rating');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRatingRequest $request)
    {
        $data = $request->validated();
        Rating::Create([
            'user_id' => auth()->user()->id,
            'recipe_id' => $request->recipe_id,
            'rating' => $request->rating,
            'review' => $request->review
        ]);
        return redirect()->back()->with('success', 'Rating added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRatingRequest  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $data = $request->validated();
        $this->authorize('update', $rating);
        
        $rating->update($data);
        
        return redirect()->back()->with('success', 'Rating updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        $this->authorize('delete', $rating);
        
        $rating->delete();

        return redirect()->back()->with('success', 'Rating deleted successfully');
    }
}
