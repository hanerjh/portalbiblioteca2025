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
        Schema::table('recurso_programas', function (Blueprint $table) {
            $table->foreign(['recurso_id'], 'recurso_programas_ibfk_1')->references(['id'])->on('recursos_digitales')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['programa_id'], 'recurso_programas_ibfk_2')->references(['id'])->on('programas_academicos')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recurso_programas', function (Blueprint $table) {
            $table->dropForeign('recurso_programas_ibfk_1');
            $table->dropForeign('recurso_programas_ibfk_2');
        });
    }
};
