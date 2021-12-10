<?php

namespace App\Http\Controllers;

use App\DataTables\FacturaDataTable;
use App\Http\Requests\factura\CreateRequest;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    function index(FacturaDataTable $tabla)
    {
        return $tabla->render('facturas.index');
    }

    function create()
    {
        return view('facturas.create');
    }

    function store(CreateRequest $request)
    {
        try {
            DB::beginTransaction();
            Factura::create([
                'numero_factura' => Factura::getConsecutivo(),
                'total'          => array_sum(array_column($request->productos, 'subtotal'))
            ])->productos()->sync($request->productos);
            DB::commit();
            return $this->responseSuccess('Factura creada satisfactoriamente');
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->responseError($th->getMessage());
        }
    }
}
