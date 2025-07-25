<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;
    protected $table = 'publicaciones';
    protected $fillable = [
        'titulo', 'slug', 'resumen', 'contenido', 'imagen_destacada', 'categoria_id', 
        'autor', 'fecha_publicacion', 'estado', 'destacado','activar_video','activar_audio'
    ];
    protected $casts = ['fecha_publicacion' => 'datetime'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaPublicacion::class, 'categoria_id');
    }
}
