<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'imageUrl' => 'required|string|max:255',
            'description'  => 'required|string',
            'price'  => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'size' => 'string|nullable',
            'color' => 'string|nullable',
            'artisan_id' => 'required|string',
            'materials' => 'required'
        ];
    }

    public function message(): array
    {
        return [
            'name.required' => 'Name for item is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not exceed 255 characters',
            'imageUrl.required' => 'imageUrl for item is required',
            'imageUrl.string' => 'imageUrl must be a string',
            'imageUrl.max' => 'imageUrl must not exceed 255 characters',
            'description.required' => 'Description for item is required',
            'description.string' => 'Description must be a string',
            'price.required' => 'Price for item is required',
            'price.integer' => 'Price must be an integer',
            'stock.required' => 'Stock for item is required',
            'stock.integer' => 'Stock must be an integer',
        ];
    }
}
