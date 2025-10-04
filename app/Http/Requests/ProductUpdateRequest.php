<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        // 🔹 Si es PUT, todos los campos son requeridos
        if ($this->isMethod('put')) {
            return [
                'name'  => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
            ];
        }

        // 🔹 Si es PATCH, solo valida los campos enviados
        return [
            'name'  => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|numeric|min:0',
        ];
    }
     /**
     * Mensajes de validación personalizados en español.
     */
    public function messages(): array
    {
        return [
            // 🔹 name
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string'   => 'El nombre debe ser un texto válido.',
            'name.max'      => 'El nombre no puede tener más de 255 caracteres.',

            // 🔹 price
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric'  => 'El precio debe ser un número.',
            'price.min'      => 'El precio no puede ser negativo.',

            // 🔹 stock
            'stock.required' => 'El stock del producto es obligatorio.',
            'stock.numeric'  => 'El stock debe ser un número.',
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
