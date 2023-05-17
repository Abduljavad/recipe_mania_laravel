<?php

namespace App\Services;

class RecipeServices
{
    public function calculateAvgRating($recipe)
    {
        foreach (range(1, 5) as $number) {
            $ratingCount = $recipe->ratings()->where('rating', $number)->count();
            $ratings[] = [
                'rating' => $number,
                'count' => $ratingCount
            ];
        }
        $totalRatings = collect($ratings)->sum('count');

        $weightedSum = collect($ratings)->sum(function ($rating) {
            return $rating['rating'] * $rating['count'];
        });
        if ($totalRatings == 0) {
            return null;
        }
        $averageRating = $weightedSum / $totalRatings;

        return $averageRating = round($averageRating, 2);
    }
}
