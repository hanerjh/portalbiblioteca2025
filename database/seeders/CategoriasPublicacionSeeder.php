<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasPublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('categorias_publicacion')->insert([
            ['nombre' => 'Noticias', 'slug' => 'noticias', 'descripcion' => 'Noticias generales de la biblioteca', 'color' => '#007bff', 'icono' => 'bi bi-newspaper'],
            ['nombre' => 'Anuncios', 'slug' => 'anuncios', 'descripcion' => 'Anuncios importantes', 'color' => '#ffc107', 'icono' => 'bi bi-megaphone'],
            ['nombre' => 'Avisos', 'slug' => 'avisos', 'descripcion' => 'Avisos institucionales', 'color' => '#17a2b8', 'icono' => 'bi bi-info-circle'],
            ['nombre' => 'Convocatorias', 'slug' => 'convocatorias', 'descripcion' => 'Convocatorias y concursos', 'color' => '#dc3545', 'icono' => 'bi bi-bullseye'],
        ]);
    }
}
