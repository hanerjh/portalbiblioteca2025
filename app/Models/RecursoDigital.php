<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoDigital extends Model
{
    use HasFactory;
    protected $table = 'recursos_digitales';
    protected $fillable = [
        'titulo', 'descripcion', 'url', 'categoria_id', 'proveedor', 'tipo_acceso', 'usuario_acceso',
        'password_acceso', 'instrucciones_acceso', 'fecha_suscripcion_inicio', 'fecha_suscripcion_fin',
        'costo_anual', 'idioma', 'cobertura_temporal', 'activo', 'destacado'
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaRecurso::class, 'categoria_id');
    }

    public function programasAcademicos()
    {
        return $this->belongsToMany(ProgramaAcademico::class, 'recurso_programas', 'recurso_id', 'programa_id');
    }

    public function areasConocimiento()
    {
        return $this->belongsToMany(AreaConocimiento::class, 'recurso_areas', 'recurso_id', 'area_id');
    }

    public function tiposUsuario()
    {
        return $this->belongsToMany(TipoUsuario::class, 'recurso_usuarios', 'recurso_id', 'tipo_usuario_id');
    }
    
    public function materialesApoyo()
    {
        return $this->belongsToMany(MaterialApoyo::class, 'recurso_materiales', 'recurso_id', 'material_id');
    }
}
