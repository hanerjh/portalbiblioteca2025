<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Programas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('programas_academicos')->insert([            

        ['nombre' => 'Administración de Negocios Internacionales'],
        ['nombre' => 'Agronomía'],
        ['nombre' => 'Arquitectura'],
        ['nombre' => 'Ingeniería de Sistemas'],
        ['nombre' => 'Ingeniería Civil'],
        ['nombre' => 'Sociología'],
        ['nombre' => 'Tecnología en Acuicultura'],
        ['nombre' => 'Tecnología en Construcciones Civiles'],
        ['nombre' => 'Tecnología en Gestión Hotelera Y Turística'],
        ['nombre' => 'Tecnología en Piscicultura'],
        ['nombre' => 'Turismo'],
        ['nombre' => 'Sin Programa Académico'],

    ]);

    }
}
