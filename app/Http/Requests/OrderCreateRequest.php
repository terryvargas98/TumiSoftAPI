<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario no existe.',
            'products.required' => 'Debe incluir al menos un producto.',
            'products.*.id.required' => 'El producto es obligatorio.',
            'products.*.id.exists' => 'Uno de los productos no existe.',
            'products.*.quantity.required' => 'Debe indicar la cantidad de cada producto.',
            'products.*.quantity.min' => 'La cantidad debe ser al menos 1.',
        ];
    }
}
