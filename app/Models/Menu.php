<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
    protected $table = 'menus';
    protected $fillable = ['nombre', 'descripcion', 'posicion', 'activo', 'orden'];

    public function items()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id')->orderBy('orden');
    }
}
