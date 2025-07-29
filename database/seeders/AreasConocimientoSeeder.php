<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasConocimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('areas_conocimiento')->insert([
            ['nombre' => 'Ciencias Naturales', 'color_fondo' => '1'],
            ['nombre' => 'Ingeniería y Tecnología', 'color_fondo' => '2'],
            ['nombre' => 'Ciencias Médicas y de la Salud', 'color_fondo' => '3'],
            ['nombre' => 'Ciencias Agrícolas', 'color_fondo' => '4'],
            ['nombre' => 'Ciencias Sociales', 'color_fondo' => '5'],
            ['nombre' => 'Humanidades', 'color_fondo' => '6'],
        ]);
    }
}
