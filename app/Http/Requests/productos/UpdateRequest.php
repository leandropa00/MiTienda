<?php

namespace App\Http\Requests\productos;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = Producto::$rules + [
            'id' => 'exists:productos,id'
        ];
        unset($rules['imagen']);
        return $rules;
    }

    public function messages()
    {
        return Producto::$messages + [
            'id.exists' => 'El producto no fue encontrado'
        ];
    }
}
