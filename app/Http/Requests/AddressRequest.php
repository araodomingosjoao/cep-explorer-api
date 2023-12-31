<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'city' => ['required', 'string'],
            'uf' => ['required', 'string', 'min:2'],
            'street' => ['required', 'string'],
            'neighborhood' => ['required', 'string'],
            'cep' => ['required', 'string', 'unique:addresses,cep', 'min:8']
        ];
    }

    public function messages()
    {
        return [
            'postal_code.regex' => 'The zip code must be in the format XXXXX-XXX.',
        ];
    }
}
