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
            ['nombre' => 'Estudiantes', 'descripcion' => 'Estudiantes de pregrado y posgrado'],
            ['nombre' => 'Docentes', 'descripcion' => 'Profesores e investigadores'],
            ['nombre' => 'Administrativos', 'descripcion' => 'Personal administrativo'],
            ['nombre' => 'Egresados', 'descripcion' => 'Graduados de la institución'],
            ['nombre' => 'Público General', 'descripcion' => 'Usuarios externos'],
        ]);
    }
}
