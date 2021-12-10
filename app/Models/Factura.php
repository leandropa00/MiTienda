<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'numero_factura',
        'total',
    ];

    protected $casts = [
        'id'             => 'integer',
        'numero_factura' => 'integer',
        'total'          => 'integer',
    ];

    public static function getConsecutivo()
    {
        return self::max('numero_factura') ?? 1;
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'productos_facturas', 'factura_id', 'producto_id')
            ->using(ProductoFactura::class)
            ->withPivot(['precio', 'cantidad', 'subtotal']);
    }
}
