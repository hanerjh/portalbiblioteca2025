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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('menu_id')->index('idx_menu_items_menu');
            $table->string('titulo', 100);
            $table->string('url')->nullable();
            $table->enum('tipo_enlace', ['interno', 'externo', 'seccion'])->nullable()->default('interno');
            $table->string('icono', 50)->nullable();
            $table->integer('parent_id')->nullable()->index('idx_menu_items_parent');
            $table->integer('orden')->nullable()->default(0);
            $table->boolean('activo')->nullable()->default(true);
            $table->boolean('target_blank')->nullable()->default(false);
            $table->timestamp('fecha_creacion')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
