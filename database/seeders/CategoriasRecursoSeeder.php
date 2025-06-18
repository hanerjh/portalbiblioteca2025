<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasRecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categorias_recurso')->insert([
            ['nombre' => 'Bases de Datos Académicas', 'descripcion' => 'Bases de datos con acceso a artículos científicos', 'tipo' => 'base_datos', 'icono' => 'bi bi-database'],
            ['nombre' => 'Revistas Electrónicas', 'descripcion' => 'Revistas académicas en formato digital', 'tipo' => 'revista', 'icono' => 'bi bi-journal-text'],
            ['nombre' => 'Repositorios Institucionales', 'descripcion' => 'Repositorios de tesis y trabajos de grado', 'tipo' => 'repositorio', 'icono' => 'bi bi-archive'],
            ['nombre' => 'Libros Electrónicos', 'descripcion' => 'Colección de libros en formato digital', 'tipo' => 'libro_digital', 'icono' => 'bi bi-book-half'],
            ['nombre' => 'Herramientas de Investigación', 'descripcion' => 'Software y herramientas para investigación', 'tipo' => 'herramienta', 'icono' => 'bi bi-wrench-adjustable-circle'],
        ]);
    }
}
