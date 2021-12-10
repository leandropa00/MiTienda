<?php

namespace App\DataTables;

use App\Models\Producto;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class StockDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->editColumn('created_at', function ($producto) {
            return $producto->created_at->format('d/m/Y g:i A');
        });
    }

    public function query()
    {
        return request()->producto->stock();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('StockTable')
            ->columns($this->getColumns())
            ->addTableClass('table table-striped dt-responsive')
            ->minifiedAjax()
            ->retrieve(true)
            ->ordering(false)
            ->language(asset('DataTables/language.json'));
    }

    protected function getColumns()
    {
        return [
            'cantidad',
            'created_at' => ['title' => 'Fecha creación'],
        ];
    }
}
