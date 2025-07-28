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
        Schema::create('tipos_usuario', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 50);
            $table->text('descripcion')->nullable();
            $table->string('color_fondo', 15);
            $table->string('color_texto', 15);
             $table->string('siglas', 7);                
            $table->boolean('activo')->nullable()->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_usuario');
    }
};
