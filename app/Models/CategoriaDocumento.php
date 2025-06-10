<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaDocumento extends Model
{
    use HasFactory;
    protected $table = 'categorias_documento';
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion', 'icono', 'activa'];

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'categoria_id');
    }
}
