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
        Schema::table('recursos_digitales', function (Blueprint $table) {
            $table->foreign(['categoria_id'], 'recursos_digitales_ibfk_1')->references(['id'])->on('categorias_recurso')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recursos_digitales', function (Blueprint $table) {
            $table->dropForeign('recursos_digitales_ibfk_1');
        });
    }
};
