<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categorias_documento')->insert([
            ['nombre' => 'Informes', 'descripcion' => 'Informes institucionales y de gestión', 'icono' => 'bi bi-file-earmark-bar-graph'],
            ['nombre' => 'Actas', 'descripcion' => 'Actas de reuniones y consejos', 'icono' => 'bi bi-file-earmark-ruled'],
            ['nombre' => 'Políticas', 'descripcion' => 'Políticas y reglamentos institucionales', 'icono' => 'bi bi-file-earmark-check'],
            ['nombre' => 'Manuales', 'descripcion' => 'Manuales de procedimientos', 'icono' => 'bi bi-book'],
            ['nombre' => 'Resoluciones', 'descripcion' => 'Resoluciones administrativas', 'icono' => 'bi bi-file-earmark-text'],
        ]);
    }
}
