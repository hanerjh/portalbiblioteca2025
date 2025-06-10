<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaRecurso extends Model
{
    use HasFactory;
    protected $table = 'categorias_recurso';
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion', 'tipo', 'icono', 'activa'];

    public function recursos()
    {
        return $this->hasMany(RecursoDigital::class, 'categoria_id');
    }
}
