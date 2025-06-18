<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // deshabilitar los campos por defecto, y dejarlo personalizado update-at y create-at
     public $timestamps = false;

    public function up(): void
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titulo', 200);
            $table->string('slug', 200)->unique('slug');
            $table->text('resumen')->nullable();
            $table->longText('contenido')->nullable();
            $table->string('imagen_destacada')->nullable();
            $table->string('url_video')->nullable();
            $table->string('url_audio')->nullable();
            $table->string('qr_code')->nullable();
            $table->integer('categoria_id')->index('idx_publicaciones_categoria');
            $table->string('autor', 100)->nullable();
            $table->dateTime('fecha_publicacion')->nullable()->useCurrent()->index('idx_publicaciones_fecha');
            $table->enum('estado', ['Borrador', 'Publicado', 'Archivado'])->nullable()->default('Borrador')->index('idx_publicaciones_estado');
            $table->boolean('destacado')->nullable()->default(false);
            $table->integer('visitas')->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();

            $table->fullText(['titulo', 'resumen', 'contenido'], 'titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
