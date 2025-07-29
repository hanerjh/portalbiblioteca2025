<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaConocimiento extends Model
{
    use HasFactory;
    protected $table = 'areas_conocimiento';
    public $timestamps = false;
    protected $fillable = ['nombre', 'color_fondo','color_texto','siglas', 'area_padre_id', 'descripcion', 'activa'];

    public function parent()
    {
        return $this->belongsTo(AreaConocimiento::class, 'area_padre_id');
    }
    
    public function children()
    {
        return $this->hasMany(AreaConocimiento::class, 'area_padre_id');
    }

    public function recursosDigitales()
    {
        return $this->belongsToMany(RecursoDigital::class, 'recurso_areas', 'area_id', 'recurso_id');
    }
}
