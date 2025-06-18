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
        Schema::create('eventos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titulo', 200);
            $table->string('slug', 200)->unique('slug');
            $table->text('descripcion')->nullable();
            $table->longText('contenido')->nullable();
            $table->string('imagen_destacada')->nullable();
            $table->integer('categoria_id')->index('idx_eventos_categoria');
            $table->string('organizador', 100)->nullable();
            $table->dateTime('fecha_inicio')->index('idx_eventos_fecha_inicio');
            $table->dateTime('fecha_fin')->nullable();
            // $table->time('hora_inicio')->nullable();
            // $table->time('hora_fin')->nullable();
            // $table->string('lugar', 200)->nullable();
            // $table->text('direccion')->nullable();
            $table->enum('modalidad', ['presencial', 'virtual', 'hibrido'])->nullable()->default('presencial');
            $table->string('url_virtual', 500)->nullable();
            // $table->integer('capacidad_maxima')->nullable();
            // $table->decimal('costo', 10)->nullable()->default(0);
            // $table->boolean('requiere_inscripcion')->nullable()->default(false);
            // $table->string('email_contacto', 100)->nullable();
            // $table->string('telefono_contacto', 20)->nullable();
            $table->enum('estado', ['borrador', 'publicado', 'cancelado', 'finalizado'])->nullable()->default('borrador')->index('idx_eventos_estado');
            $table->boolean('destacado')->nullable()->default(false);
            //$table->integer('visitas')->nullable()->default(0);
             $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();

            $table->fullText(['titulo', 'descripcion', 'contenido'], 'titulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
