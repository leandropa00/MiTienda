<?php

namespace App\Http\Requests\stock;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function __construct()
    {
        $this->min = request()->producto->cantidad_minima;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cantidad' => "required|numeric|min:{$this->min}"
        ];
    }

    public function messages()
    {
        return [
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.numeric'  => 'La cantidad debe ser numérica',
            'cantidad.min'      => "La cantidad mínima es {$this->min}"
        ];
    }
}
