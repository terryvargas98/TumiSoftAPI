<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
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
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|gte:min_price',
            'order_by_stock' => 'nullable|in:asc,desc'
        ];
    }

    public function messages(): array
    {
        return [
            'min_price.numeric' => 'El precio mínimo debe ser un número.',
            'max_price.numeric' => 'El precio máximo debe ser un número.',
            'max_price.gte' => 'El precio máximo debe ser mayor o igual al mínimo.',
            'order_by_stock.in' => 'El orden por stock debe ser "asc" o "desc".'
        ];
    }
}
