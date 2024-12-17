<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'servings' => 'required',
            'ingredients' => 'required|array',
            'steps' => 'required|array',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:31800000',
        ];
    }
}
