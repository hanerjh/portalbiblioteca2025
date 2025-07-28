<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tipos_usuario')->insert([
            [
        'nombre' => 'Estudiantes',
        'descripcion' => 'Estudiantes de pregrado y posgrado',
        'color_fondo' => '#233bc5ff',
        'color_texto' => '#000000',
        'siglas' => 'Est',
    ],
    [
        'nombre' => 'Docentes',
        'descripcion' => 'Profesores e investigadores',
        'color_fondo' => '#33e9d7',
        'color_texto' => '#000000',
        'siglas' => 'Doc',
    ],
    [
        'nombre' => 'Administrativos',
        'descripcion' => 'Personal administrativo',
        'color_fondo' => '#796011ff',
        'color_texto' => '#ffffff',
        'siglas' => 'Adm',
    ],
    [
        'nombre' => 'Egresados',
        'descripcion' => 'Graduados de la institución',
        'color_fondo' => '#32fc4f',
        'color_texto' => '#000000',
        'siglas' => 'Egr',
    ],
    [
        'nombre' => 'Público General',
        'descripcion' => 'Usuarios externos',
        'color_fondo' => '#f61f68',
        'color_texto' => '#ffffff',
        'siglas' => 'PG',
    ],
        ]);

        
    }
}
