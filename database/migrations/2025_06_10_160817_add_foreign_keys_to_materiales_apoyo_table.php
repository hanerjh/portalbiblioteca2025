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
        Schema::table('materiales_apoyo', function (Blueprint $table) {
            $table->foreign(['categoria_id'], 'materiales_apoyo_ibfk_1')->references(['id'])->on('categorias_material_apoyo')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['recurso_id'], 'recurso_digital_ibfk_1')->references(['id'])->on('recursos_digitales')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiales_apoyo', function (Blueprint $table) {
            $table->dropForeign('materiales_apoyo_ibfk_1');
             $table->dropForeign('recurso_digital_ibfk_1');
        });
    }
};
