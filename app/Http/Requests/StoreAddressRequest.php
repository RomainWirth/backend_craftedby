<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'street' => 'required|string|max:255',
            'postalCode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'countryCode' => 'required|string|max:3'
        ];
    }

    public function message(): array
    {
        return [
            'street.required' => 'The street field is required',
            'street.string' => 'The street field must be a string',
            'street.max' => 'The street field must not exceed 255 characters',
            'postalCode.required' => 'The postalCode field is required',
            'postalCode.string' => 'The postalCode field must be a string',
            'postalCode.max' => 'The postalCode field must not exceed 255 characters',
            'city.required' => 'The city field is required',
            'city.string' => 'The city field must be a string',
            'city.max' => 'The city field must not exceed 255 characters',
            'countryCode.required' => 'The countryCode field is required',
            'countryCode.string' => 'The countryCode field must be a string',
            'countryCode.max' => 'The countryCode field must not exceed 3 characters',
        ];
    }
}
