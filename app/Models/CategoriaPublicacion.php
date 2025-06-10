<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaPublicacion extends Model
{
    use HasFactory;
    protected $table = 'categorias_publicacion';
    public $timestamps = false;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'color', 'icono', 'activa'];

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'categoria_id');
    }
}
