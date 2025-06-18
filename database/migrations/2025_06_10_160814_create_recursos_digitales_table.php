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
        Schema::create('recursos_digitales', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titulo', 200);
            $table->longText('descripcion')->nullable();
            $table->string('url', 500)->nullable();
            $table->integer('categoria_id')->index('idx_recursos_categoria');
            $table->string('proveedor', 150)->nullable();
            $table->enum('tipo_acceso', ['Acceso abierto', 'restringido', 'suscripcion'])->nullable()->default('Acceso abierto')->index('idx_recursos_acceso');
            $table->text('instrucciones_acceso')->nullable();
            $table->date('fecha_suscripcion_inicio')->nullable();
            $table->date('fecha_suscripcion_fin')->nullable();
            $table->decimal('costo_anual', 10)->nullable();
            $table->string('idioma', 10)->nullable()->default('es');
            $table->string('cobertura_temporal', 100)->nullable();
            $table->boolean('activo')->nullable()->default(true);
            $table->boolean('destacado')->nullable()->default(false);
            $table->integer('visitas')->nullable()->default(0);
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
        Schema::dropIfExists('recursos_digitales');
    }
};
