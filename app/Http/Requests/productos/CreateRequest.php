<?php

namespace App\Http\Requests\productos;

use App\Models\Producto;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return Producto::$rules;
    }

    public function messages()
    {
        return Producto::$messages;
    }
}
