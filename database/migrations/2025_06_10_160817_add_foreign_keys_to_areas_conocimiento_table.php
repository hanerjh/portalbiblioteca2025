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
        Schema::table('areas_conocimiento', function (Blueprint $table) {
            $table->foreign(['area_padre_id'], 'areas_conocimiento_ibfk_1')->references(['id'])->on('areas_conocimiento')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('areas_conocimiento', function (Blueprint $table) {
            $table->dropForeign('areas_conocimiento_ibfk_1');
        });
    }
};
