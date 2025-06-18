<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Crear menús
        $menuPrincipalId = DB::table('menus')->insertGetId(
            ['nombre' => 'Principal', 'descripcion' => 'Menú principal del sitio', 'posicion' => 'header', 'activo' => true]
        );
        
        DB::table('menus')->insert(
            ['nombre' => 'Footer', 'descripcion' => 'Menú del pie de página', 'posicion' => 'footer', 'activo' => true]
        );

        // Crear items para el menú principal
        DB::table('menu_items')->insert([
            ['menu_id' => $menuPrincipalId, 'titulo' => 'Inicio', 'url' => '/', 'orden' => 1],
            ['menu_id' => $menuPrincipalId, 'titulo' => 'Recursos Digitales', 'url' => '/recursos', 'orden' => 2],
            ['menu_id' => $menuPrincipalId, 'titulo' => 'Publicaciones', 'url' => '/publicaciones', 'orden' => 3],
            ['menu_id' => $menuPrincipalId, 'titulo' => 'Documentos', 'url' => '/documentos', 'orden' => 4],
            ['menu_id' => $menuPrincipalId, 'titulo' => 'Contacto', 'url' => '/contacto', 'orden' => 5],
        ]);
    }
}
