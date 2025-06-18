<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasEventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias_evento')->insert([
            ['nombre' => 'Conferencias', 'slug' => 'conferencias', 'descripcion' => 'Conferencias académicas y científicas', 'color' => '#28a745', 'icono' => 'bi bi-mic'],
            ['nombre' => 'Talleres', 'slug' => 'talleres', 'descripcion' => 'Talleres y cursos de formación', 'color' => '#fd7e14', 'icono' => 'bi bi-tools'],
            ['nombre' => 'Seminarios', 'slug' => 'seminarios', 'descripcion' => 'Seminarios y charlas especializadas', 'color' => '#6f42c1', 'icono' => 'bi bi-presentation'],
            ['nombre' => 'Actividades Culturales', 'slug' => 'actividades-culturales', 'descripcion' => 'Eventos culturales y artísticos', 'color' => '#e83e8c', 'icono' => 'bi bi-palette'],
            ['nombre' => 'Capacitaciones', 'slug' => 'capacitaciones', 'descripcion' => 'Cursos de capacitación bibliotecaria', 'color' => '#20c997', 'icono' => 'bi bi-person-video3'],
        ]);
    }
}
