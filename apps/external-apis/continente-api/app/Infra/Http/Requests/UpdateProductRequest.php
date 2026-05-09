<?php

namespace App\Infra\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'price' => ['required_without:name', 'numeric'],
            'name' => ['required_without:price', 'string'],
            'productId' => ['required', 'string'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['productId' => request()->route('id')]);
    }
}