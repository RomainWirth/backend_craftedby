<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtisanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'siret' => 'integer', // add required when logic implemented
            'theme_id' => 'required|uuid',
            'user_id' => 'required|uuid',
        ];
    }
}
