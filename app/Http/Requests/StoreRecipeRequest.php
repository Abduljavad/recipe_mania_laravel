<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'instructions' => 'required',
            'img' => 'image|mimes:png,jpg,jpeg|max:5120',
            'category_id' =>'required|exists:categories,id',
            'cuisine_id' => 'required|exists:cuisines,id',
            'difficulty_level_id' => 'required|exists:difficulty_levels,id',
            'ingredients_name' => 'array',
            'ingredients_quantity' => 'array',
        ];
    }
}
