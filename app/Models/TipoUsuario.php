<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
     use HasFactory;
    protected $table = 'tipos_usuario';
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion', 'activo'];

    public function recursosDigitales()
    {
        return $this->belongsToMany(RecursoDigital::class, 'recurso_usuarios', 'tipo_usuario_id', 'recurso_id');
    }
}
