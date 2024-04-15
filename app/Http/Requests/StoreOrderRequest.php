<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'totalPrice' => 'required|integer',
            'sendStatus' => 'required|boolean|false',
            'cart_id' => 'required'
        ];
    }

    public function message(): array
    {
        return [
            'totalPrice.required' => 'total price is required',
            'totalPrice.integer' => 'total price must be a number',

            'sendStatus.required' => 'send status is required',
            'sendStatus.boolean' => 'send status only accept true or false',
            'sendStatus.false' => 'send status is false by default',

            'cart_id.required' => 'cart id is required',
        ];
    }
}
