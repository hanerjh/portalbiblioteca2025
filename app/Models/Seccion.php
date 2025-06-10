<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = ['nombre', 'slug', 'titulo_seo', 'descripcion_seo', 'contenido', 'template', 'activa'];

}
