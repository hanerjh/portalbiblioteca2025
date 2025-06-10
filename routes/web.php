<?php

use App\Models\CategoriaEvento;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/home', fn()=> view('home'));

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('categoriaeventos', function(){
        
    $resul = CategoriaEvento::all();
    return $resul;
//     //creamos un objeto del modelo
//     $catEventos = new CategoriaEvento;
//    // registrar informacion en la tabla
//     $catEventos->nombre = 'Festivales';
//     $catEventos->slug = '';
//     $catEventos->save(); 

});

Route::view('dashboard', 'backend_admin.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    

Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
