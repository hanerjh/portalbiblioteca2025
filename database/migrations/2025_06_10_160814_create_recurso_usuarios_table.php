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
        Schema::create('recurso_usuarios', function (Blueprint $table) {
            $table->integer('recurso_id');
            $table->integer('tipo_usuario_id')->index('tipo_usuario_id');

            $table->primary(['recurso_id', 'tipo_usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurso_usuarios');
    }
};
