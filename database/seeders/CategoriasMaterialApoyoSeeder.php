<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasMaterialApoyoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categorias_material_apoyo')->insert([
            ['nombre' => 'Bases de Datos', 'descripcion' => 'Tutoriales para uso de bases de datos académicas', 'icono' => 'bi bi-server'],
            ['nombre' => 'Herramientas de Búsqueda', 'descripcion' => 'Guías para búsquedas especializadas', 'icono' => 'bi bi-search'],
            ['nombre' => 'Gestores Bibliográficos', 'descripcion' => 'Manuales de Mendeley, Zotero, EndNote', 'icono' => 'bi bi-journal-bookmark'],
            ['nombre' => 'Acceso Remoto', 'descripcion' => 'Instrucciones para acceso desde casa', 'icono' => 'bi bi-house-door'],
            ['nombre' => 'Plataformas Digitales', 'descripcion' => 'Uso de plataformas y repositorios', 'icono' => 'bi bi-display'],
            ['nombre' => 'Servicios Bibliotecarios', 'descripcion' => 'Guías de servicios de la biblioteca', 'icono' => 'bi bi-info-square'],
        ]);
    }
}
