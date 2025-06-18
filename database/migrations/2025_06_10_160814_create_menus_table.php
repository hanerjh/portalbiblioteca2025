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
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->string('posicion', 50)->nullable()->default('header');
            $table->boolean('activo')->nullable()->default(true);
            $table->integer('orden')->nullable()->default(0);
             $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
