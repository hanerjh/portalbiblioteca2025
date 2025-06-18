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
            ['nombre' => 'Ciencias Naturales', 'codigo' => '1'],
            ['nombre' => 'Ingeniería y Tecnología', 'codigo' => '2'],
            ['nombre' => 'Ciencias Médicas y de la Salud', 'codigo' => '3'],
            ['nombre' => 'Ciencias Agrícolas', 'codigo' => '4'],
            ['nombre' => 'Ciencias Sociales', 'codigo' => '5'],
            ['nombre' => 'Humanidades', 'codigo' => '6'],
        ]);
    }
}
