<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'cantidad',
    ];

    protected $casts = [
        'id'          => 'integer',
        'producto_id' => 'string',
        'cantidad'    => 'integer',
    ];
}
