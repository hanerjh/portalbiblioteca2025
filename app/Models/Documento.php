<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;
    protected $table = 'documentos';
    protected $fillable = [
        'titulo', 'descripcion', 'archivo_nombre', 'archivo_ruta', 'archivo_tamaño', 'tipo_mime',
        'categoria_id', 'autor', 'fecha_documento', 'numero_documento', 'publico'
    ];
    protected $casts = ['fecha_documento' => 'date'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaDocumento::class, 'categoria_id');
    }
}
