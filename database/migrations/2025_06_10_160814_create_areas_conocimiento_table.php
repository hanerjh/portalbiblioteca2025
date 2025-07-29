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
        Schema::create('areas_conocimiento', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 100);
            $table->string('color_fondo', 20)->nullable();
            $table->string('color_texto', 20)->nullable();
            $table->string('siglas', 7)->nullable();
            $table->integer('area_padre_id')->nullable()->index('area_padre_id');
            $table->text('descripcion')->nullable();
            $table->boolean('activa')->nullable()->default(true);
             $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas_conocimiento');
    }
};
