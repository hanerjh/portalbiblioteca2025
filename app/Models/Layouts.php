<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layouts extends Model
{
    protected $fillable = [
        'name',       // Nombre visible en el panel admin (ej: "Público", "Admin", "Marketing")
        'view_path',  // Ruta del layout Blade (ej: "components.layouts.publico_layout_page")
    ];

    /**
     * Un layout puede estar asociado a muchas páginas.
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
