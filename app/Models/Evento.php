<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $fillable = [
        'titulo', 'slug', 'descripcion', 'contenido', 'imagen_destacada', 'categoria_id', 'organizador',
        'fecha_inicio', 'fecha_fin', 'hora_inicio', 'hora_fin', 'lugar', 'direccion', 'modalidad',
        'archivo', 'capacidad_maxima', 'costo', 'requiere_inscripcion', 'email_contacto',
        'telefono_contacto', 'estado', 'destacado'
    ];
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaEvento::class, 'categoria_id');
    }
}
