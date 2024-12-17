<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Set to true for simplicity. Add authorization logic if needed.
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'ingredients' => 'sometimes|array',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:31800000',
            'servings' => 'required',
            'steps' => 'sometimes|array',
        ];
    }
}
