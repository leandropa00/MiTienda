<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'extension_imagen',
        'cantidad_minima',
    ];

    protected $casts = [
        'nombre'           => 'string',
        'descripcion'      => 'string',
        'precio'           => 'integer',
        'extension_imagen' => 'string',
        'cantidad_minima'  => 'integer',
    ];

    public static $rules = [
        'imagen'           => 'required|image',
        'nombre'           => 'required|max:50',
        'descripcion'      => 'required|max:120',
        'precio'           => 'required|max:12',
        'cantidad_minima'  => 'required|numeric|min:1|max:32767',
    ];

    public static $messages = [
        'imagen.required'          => 'La imagen es requerida',
        'imagen.image'             => 'La imagen es inválida',
        'nombre.required'          => 'El nombre es requerido',
        'nombre.max'               => 'El nombre supera la longitud permitida',
        'descripcion.required'     => 'La descripción es requerida',
        'descripcion.max'          => 'La descripción supera la longitud permitida',
        'precio.required'          => 'El precio es requerido',
        'precio.max'               => 'El precio supera el permitido',
        'cantidad_minima.required' => 'La cantidad mínima es requerida',
        'cantidad_minima.numeric'  => 'La cantidad mínima debe ser numérica',
        'cantidad_minima.min'      => 'La cantidad mínima no debe ser inferior a 1',
        'cantidad_minima.max'      => 'La cantidad mínima supera la permitida',
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class, 'producto_id');
    }

    public function cargarImagen($foto): void
    {
        $foto->storeAs('imagenes_productos', "{$this->id}.{$this->extension_imagen}");
    }

    public function actualizarImagen($foto, $extension): void
    {
        $this->eliminarImagen();
        $foto->storeAs('imagenes_productos', "{$this->id}.{$extension}");
    }

    public function getRutaImagenAttribute()
    {
        return "storage/imagenes_productos/{$this->id}.{$this->extension_imagen}";
    }

    public function eliminarImagen()
    {
        $ruta = public_path($this->ruta_imagen);
        is_file($ruta) && unlink($ruta);
        return $this;
    }
}
