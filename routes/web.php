<?php

use App\Http\Controllers\principalwebController;
use App\Livewire\Admin\GestionEventos;
use App\Livewire\Admin\GestionPublicaciones;
use App\Livewire\Admin\Publicacion;
use App\Models\CategoriaEvento;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Frontend\PaginaRecursos; 

Route::resource('/inicio', principalwebController::class);
/** Ruta de ingreso a paginas, mediante id */
Route::get('/page/{id}', function (string $id) {
    return 'User '.$id;
});

Route::get('/home', fn()=> view('home'));

Route::get('/', function () {
    return view('welcome');
})->name('home');


// Ruta pública para ver los recursos
Route::get('/recursos-electronicos', PaginaRecursos::class)->name('recursos.public.index');


/* Route::get('/publicaciones', GestionPublicaciones::class)->name('publicaciones.index');
Route::get('/eventos', GestionEventos::class)->name('eventos.index'); */

Route::get('categoriaeventos', function(){
        
    
    //$resul = CategoriaEvento::all();
    //return $resul;

    /*   //creamos un objeto del modelo
    $catEventos = new CategoriaEvento;    
   // registrar informacion en la tabla
    $catEventos->nombre = 'Festivales';
    $catEventos->slug = '';
    $catEventos->save();  */

    
    // actualizamos el nombre del evento por nuevo evento. esto funciona por en la linea anterio ya tenemos el registro.                
    $catEventos = CategoriaEvento::find(1); // Retorna el registro numero 1
    $catEventos2 = CategoriaEvento::where('nombre','Conferencias')// Retorna el registro don en el campo nombre sea igual a conferencia
                    ->first(); 
    $catEventos2->nombre = 'Nueva categoria';
    $catEventos2->save();
    

});

/* Route::view('dashboard', 'backend_admin.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */
    
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
