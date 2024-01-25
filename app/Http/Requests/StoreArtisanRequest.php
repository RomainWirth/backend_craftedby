<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtisanRequest extends FormRequest
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
            'companyName' => 'required|string|max:255',
            'about' => 'text',
            'craftingDescription' => 'text',
            'siret' => 'required|integer',
            'theme_id' => 'required|uuid',
            'user_id' => 'required|uuid',
        ];
    }
    public function message(): array
    {
        return [
            'companyName.string' => 'The companyName must be a string.',
            'companyName.max' => 'The companyName must not exceed 255 characters.',
            'companyName.required' => 'The companyName field is required'
        ];
    }
}
