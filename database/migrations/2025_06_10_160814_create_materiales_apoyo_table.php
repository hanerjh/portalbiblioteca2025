<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materiales_apoyo', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titulo', 200);
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['videotutorial', 'manual', 'guia', 'infografia', 'documento'])->index('idx_materiales_tipo');
            $table->integer('categoria_id')->index('idx_materiales_categoria');
            $table->integer('recurso_id')->nullable()->index('idx_recurso_digital');
            $table->string('url_recurso', 500);
            $table->string('duracion', 20)->nullable();
            $table->string('imagen_miniatura')->nullable();
            $table->enum('nivel_dificultad', ['basico', 'intermedio', 'avanzado'])->nullable()->default('basico');
            $table->string('idioma', 10)->nullable()->default('es');
            $table->string('autor', 100)->nullable();
            $table->enum('estado', ['Borrador', 'Publicado', 'Archivado'])->nullable()->default('Borrador')->index('idx_materiales_estado');
            $table->boolean('destacado')->nullable()->default(false);
            $table->integer('orden_visualizacion')->nullable()->default(0);
            $table->integer('visualizaciones')->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();

            $table->fullText(['titulo', 'descripcion'], 'titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales_apoyo');
    }
};
