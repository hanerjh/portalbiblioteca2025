<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaMaterialApoyo extends Model
{
    protected $table = 'categorias_material_apoyo';
    public $timestamps = false; // Esta tabla no tiene updated_at

    protected $fillable = [
        'nombre',
        'descripcion',
        'icono',
        'activa',
    ];

    /**
     * Una categoría tiene muchos materiales de apoyo.
     */
    public function materiales()
    {
        return $this->hasMany(MaterialApoyo::class, 'categoria_id');
    }
}
