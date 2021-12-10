<?php

namespace App\DataTables;

use App\Models\Factura;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class FacturaDataTable extends DataTable
{
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->editColumn('created_at', function ($producto) {
                return $producto->created_at->format('d/m/Y');
            });
    }

    public function query(Factura $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('FacturaTable')
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
            'numero_factura',
            'total',
            'created_at'      => ['title' => 'Fecha creación'],
        ];
    }
}
