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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreign(['menu_id'], 'menu_items_ibfk_1')->references(['id'])->on('menus')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['parent_id'], 'menu_items_ibfk_2')->references(['id'])->on('menu_items')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign('menu_items_ibfk_1');
            $table->dropForeign('menu_items_ibfk_2');
        });
    }
};
