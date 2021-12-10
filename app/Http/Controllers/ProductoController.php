<?php

namespace App\Http\Controllers;

use App\DataTables\ProductosDataTable;
use App\Http\Requests\productos\CreateRequest;
use App\Http\Requests\productos\UpdateRequest;
use App\Models\Producto;

class ProductoController extends Controller
{
    function index(ProductosDataTable $tabla)
    {
        return $tabla->render('productos.index');
    }

    function create()
    {
        return view('productos.create');
    }

    function store(CreateRequest $request)
    {
        $imagen = $request->file('imagen');
        $request['precio'] = preg_replace('([^0-9])', '', $request->precio);
        $request['extension_imagen'] = $imagen->getClientOriginalExtension();
        Producto::create($request->all())->cargarImagen($imagen);
        return $this->responseSuccess('Producto creado satisfactoriamente');
    }

    function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    function update(Producto $producto, UpdateRequest $request)
    {
        if ($imagen = $request->file('imagen')) {
            $request['extension_imagen'] = $imagen->getClientOriginalExtension();
            $producto->actualizarImagen($imagen, $request['extension_imagen']);
        }
        $request['precio'] = preg_replace('([^0-9])', '', $request->precio);
        $producto->update($request->all());
        return $this->responseSuccess('Producto actualizado satisfactoriamente');
    }

    function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            $producto->eliminarImagen();
            return $this->responseSuccess('Producto eliminado satisfactoriamente');
        } catch (\Throwable $th) {
            return $this->responseError(
                $th->getCode() == 23000 ? 
                'El producto tiene información relacionada' : 
                $th->getMessage()
            );
        }
    }
}
