<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaEvento extends Model
{
    //
    use HasFactory;
    //El modelo se conecta con la tabla categoria eventos gestionar o administrar los datos
    protected $table='categorias_evento';

     
    public $timestamps = false;
    protected $fillable = ['nombre', 'slug', 'descripcion', 'color', 'icono', 'activa'];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'categoria_id');
    }
    
}
