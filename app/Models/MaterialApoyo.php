<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialApoyo extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'materiales_apoyo';
    
    // Deshabilitar timestamps si la tabla no los tiene (esta sí los tiene)
    // public $timestamps = true;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'categoria_id',
        'url_recurso',
        'duracion',
        'tamaño_archivo',
        'tipo_mime',
        'imagen_miniatura',
        'nivel_dificultad',
        'idioma',
        'autor',
        'estado',
        'destacado',
        'orden_visualizacion',
    ];

    // Casts para convertir tipos de datos
    protected $casts = [
        'destacado' => 'boolean',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    /**
     * Define la relación con CategoriaMaterialApoyo.
     * Un material de apoyo pertenece a una categoría.
     */
    public function categoria()
    {
        return $this->belongsTo(CategoriaMaterialApoyo::class, 'categoria_id');
    }

     public function recursosDigitales()
    {
        return $this->belongsToMany(RecursoDigital::class, 'recurso_materiales', 'material_id', 'recurso_id');
    }
}
