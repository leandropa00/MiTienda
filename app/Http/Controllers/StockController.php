<?php

namespace App\Http\Controllers;

use App\DataTables\StockDataTable;
use App\Http\Requests\stock\CreateRequest;
use App\Models\Producto;

class StockController extends Controller
{
    function index(Producto $producto, StockDataTable $tabla)
    {
        return $tabla->render('productos.stock.index', compact('producto'));
    }

    function create(Producto $producto)
    {
        return view('productos.stock.create', compact('producto'));
    }

    function store(Producto $producto, CreateRequest $request)
    {
        $producto->stock()->create($request->only('cantidad'));
        return $this->responseSuccess('Stock creado satisfactoriamente');
    }
}
