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
        Schema::create('documentos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titulo', 200);
            $table->text('descripcion')->nullable();
            $table->string('archivo_nombre');
            $table->string('archivo_ruta', 500);
            $table->integer('archivo_tamaño')->nullable();
            $table->string('tipo_mime', 100)->nullable();
            $table->integer('categoria_id')->index('idx_documentos_categoria');
            $table->string('autor', 100)->nullable();
            $table->date('fecha_documento')->nullable();
            $table->string('numero_documento', 50)->nullable();
            $table->boolean('publico')->nullable()->default(true);
            $table->integer('descargas')->nullable()->default(0);
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
        Schema::dropIfExists('documentos');
    }
};
