<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'user_id' => 'required|string|max:255',
            'paymentStatus' => 'required|boolean|false',
        ];
    }

    public function message(): array
    {
        return [
            'user_id.required' => 'user id is required',
            'user_id.string' => 'user_id must be a string',
            'user_id.max' => 'user_id cannot exceed 255 characters',

            'paymentStatus.required' => 'payment status is required',
            'paymentStatus.boolean' => 'payment status only accept true or false',
            'paymentStatus.false' => 'payment status is false by default',
        ];
    }
}
