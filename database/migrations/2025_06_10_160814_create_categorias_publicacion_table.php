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
        Schema::create('categorias_publicacion', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 100);
            $table->string('slug', 100)->unique('slug');
            $table->text('descripcion')->nullable();
            $table->string('color', 7)->nullable()->default('#007bff');
            $table->string('icono', 50)->nullable();
            $table->boolean('activa')->nullable()->default(true);
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_publicacion');
    }
};
