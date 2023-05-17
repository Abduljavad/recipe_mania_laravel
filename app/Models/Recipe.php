<?php

namespace App\Models;

use App\Services\RecipeServices;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }

    public function difficultyLevel(): BelongsTo
    {
        return $this->belongsTo(DifficultyLevel::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function cuisine(): BelongsTo
    {
        return $this->belongsTo(cuisine::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredients::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function comments():HasMany
    // {
    //     return $this->hasMany(Comment::class);
    // }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function scopeByCategory($query, $request)
    {
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
    }

    public function scopeByCuisine($query, $request)
    {
        if ($request->cuisine_id) {
            $query->where('cuisine_id', $request->cuisine_id);
        }
    }

    public function scopeByName($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    }

    public function scopeByDifficulty($query, $request)
    {
        if ($request->difficulty_level_id) {
            $query->where('difficulty_level_id', $request->difficulty_level_id);
        }
    }

    public function avgRating(Recipe $recipe)
    {
        $recipeServices = new RecipeServices;
        return $recipeServices->calculateAvgRating($recipe);
    }
}
