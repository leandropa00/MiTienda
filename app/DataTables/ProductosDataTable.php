<?php

namespace App\DataTables;

use App\Models\Producto;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProductosDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'productos.actions')
            ->editColumn('precio', function ($producto) {
                return '$'.number_format($producto->precio, 0, ',', '.');
            })
            ->addColumn('stock', function ($producto) {
                return $producto->stock;
            })
            ->editColumn('created_at', function ($producto) {
                return $producto->created_at->format('d/m/Y');
            });
    }

    public function query(Producto $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('ProductosTable')
            ->columns($this->getColumns())
            ->addTableClass('table table-striped dt-responsive')
            ->minifiedAjax()
            ->addAction(['title' => 'Acción', 'width' => '120px'])
            ->retrieve(true)
            ->ordering(false)
            ->language(asset('DataTables/language.json'));
    }

    protected function getColumns()
    {
        return [
            'nombre',
            'descripcion'     => ['title' => 'Descripción'],
            'precio',
            'cantidad_minima' => ['title' => 'Cantidad mínima'],
            'stock',
            'created_at'      => ['title' => 'Fecha creación'],
        ];
    }
}
