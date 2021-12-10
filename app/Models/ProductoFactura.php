<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductoFactura extends Pivot
{
    public $table = 'productos_facturas';

    protected $casts = [
        'id'       => 'integer',
        'precio'   => 'integer',
        'cantidad' => 'integer',
        'subtotal' => 'integer',
    ];
}
