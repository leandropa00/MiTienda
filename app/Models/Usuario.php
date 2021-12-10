<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nombre', 'correo', 'clave',
    ];

    protected $hidden = [
        'clave', 'remember_token',
    ];

    protected $casts = [
        'nombre' => 'string',
        'correo' => 'string',
        'clave'  => 'string',
    ];

    public function getAuthPassword()
    {
        return $this->clave;
    }
}
