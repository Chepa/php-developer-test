<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'price' => ['nullable'],
            'bedrooms' => ['nullable', 'numeric'],
            'bathrooms' => ['nullable', 'numeric'],
            'storeys' => ['nullable', 'numeric'],
            'garages' => ['nullable', 'numeric'],
            'page' => ['nullable', 'numeric'],
        ];
    }
}
