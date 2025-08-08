<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',       // Título visible de la página
        'slug',        // URL amigable (ej: "nosotros", "contacto")
        'content',     // HTML o JSON según tu editor
        'layout_id',   // FK al layout
        'published_at' // Opcional si quieres programar publicación
    ];

    /**
     * Relación con el layout.
     */
    public function layout()
    {
        return $this->belongsTo(Layouts::class);
    }

    /**
     * Scope para filtrar solo páginas publicadas.
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}
