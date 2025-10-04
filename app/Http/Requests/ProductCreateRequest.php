<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
        ];
    }
     public function messages(): array
    {
        return [
            'name.required'  => 'El nombre del producto es obligatorio.',
            'name.string'    => 'El nombre debe ser texto.',

            'price.required' => 'El precio es obligatorio.',
            'stock.numeric'  => 'El stock debe ser un número válido (puede incluir decimales).',
            'price.min'      => 'El precio no puede ser negativo.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.numeric'  => 'El stock debe ser un número entero.',
            'stock.min'      => 'El stock no puede ser menor a 0.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'  => 'nombre',
            'price' => 'precio',
            'stock' => 'stock',
        ];
    }
}
