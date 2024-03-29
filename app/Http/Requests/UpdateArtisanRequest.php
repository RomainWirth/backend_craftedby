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
            'companyName' => 'string|max:255',
            'about' => 'string',
            'craftingDescription' => 'string',
            'siret' => 'integer', // add required when logic implemented
            'theme' => 'required|string',
//            'user_id' => 'required|string|uuid',
        ];
    }
    public function message(): array
    {
        return [
            'companyName.string' => 'The companyName must be a string.',
            'companyName.max' => 'The companyName must not exceed 255 characters.',

            'about.string' => 'You need to add a quick paragraph.',

            'craftingDescription.string' => 'You need to add a description of you crafting method.',

            'siret.integer' => 'Field must be integers.',
        ];
    }
}
