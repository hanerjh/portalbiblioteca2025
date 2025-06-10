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
        Schema::create('logs_actividad', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('accion', 100);
            $table->string('tabla_afectada', 50)->nullable();
            $table->integer('registro_id')->nullable();
            $table->string('usuario', 100)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->json('detalles')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_actividad');
    }
};
