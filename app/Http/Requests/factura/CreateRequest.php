<?php

namespace App\Http\Requests\factura;

use App\Models\Factura;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return Factura::$rules;
    }

    public function messages()
    {
        return Factura::$messages;
    }
}
