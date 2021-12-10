<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class ViewVariables
{
    public function handle($request, Closure $next)
    {
        //* Configuraciones globales de bootstrap para los campos
        View::composer(['*'], function ($view) {
            $select = ['class' => 'form-control selectpicker bordered', 'data-style' => 'form-control', 'data-live-search' => 'true', 'title' => 'Seleccione', 'data-size' => '5'];
            $input = ['class' => 'form-control'];
            $moneda = ['class' => 'form-control maskmoney'];
            $datetimepicker = ['class' => 'form-control datetimepicker', 'autocomplete' => 'no'];
            $textarea = ['class' => 'form-control', 'rows' => '5'];
            $inputFiltro = ['class' => 'form-control filtro'];
            $inputNumeric = ['class' => 'form-control', 'onkeyup' => 'this.value = soloNumeros(this.value, true)'];
            $sesion = auth()->user();
            $view->with(compact('select', 'input', 'inputFiltro', 'textarea', 'datetimepicker', 'moneda', 'sesion', 'inputNumeric'));
        });

        return $next($request);
    }
}
