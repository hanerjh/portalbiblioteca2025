<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaAcademico extends Model
{
    use HasFactory;
    protected $table = 'programas_academicos';
    public $timestamps = false;
    protected $fillable = ['nombre', 'codigo', 'facultad', 'nivel', 'activo'];
    
    public function recursosDigitales()
    {
        return $this->belongsToMany(RecursoDigital::class, 'recurso_programas', 'programa_id', 'recurso_id');
    }
}
