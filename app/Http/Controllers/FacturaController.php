<?php

namespace App\Http\Controllers;

use App\DataTables\FacturaDataTable;

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

    // function store(CreateRequest $request)
    // {
    //     $imagen = $request->file('imagen');
    //     $request['precio'] = preg_replace('([^0-9])', '', $request->precio);
    //     $request['extension_imagen'] = $imagen->getClientOriginalExtension();
    //     Producto::create($request->all())->cargarImagen($imagen);
    //     return $this->responseSuccess('Producto creado satisfactoriamente');
    // }

    // function edit(Producto $producto)
    // {
    //     return view('productos.edit', compact('producto'));
    // }

    // function update(Producto $producto, UpdateRequest $request)
    // {
    //     if ($imagen = $request->file('imagen')) {
    //         $request['extension_imagen'] = $imagen->getClientOriginalExtension();
    //         $producto->actualizarImagen($imagen, $request['extension_imagen']);
    //     }
    //     $request['precio'] = preg_replace('([^0-9])', '', $request->precio);
    //     $producto->update($request->all());
    //     return $this->responseSuccess('Producto actualizado satisfactoriamente');
    // }

    // function destroy(Producto $producto)
    // {
    //     $producto->eliminarImagen()->delete();
    //     return $this->responseSuccess('Producto eliminado satisfactoriamente');
    // }
}
