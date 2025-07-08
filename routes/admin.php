<?php

use App\Livewire\Admin\GestionCategoriasEvento;
use App\Livewire\Admin\GestionCategoriasMaterial;
use App\Livewire\Admin\GestionCategoriasPublicacion;
use App\Livewire\Admin\GestionDocumentos;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\GestionPublicaciones;
use App\Livewire\Admin\GestionEventos;
use App\Livewire\Admin\GestionMaterialApoyo;
use App\Livewire\Admin\GestionMenuItems;
use App\Livewire\Admin\GestionMenus;
use App\Livewire\Admin\GestionRecursos;
use App\Livewire\Admin\GestionSecciones;
use App\Livewire\Admin\RecursosSortable;

use Illuminate\Support\Facades\Auth;

// Asume que tienes un layout de administración y un middleware de autenticación 'auth'

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Vista del panel de administración
    })->name('dashboard');

    
});

    // Rutas para cada módulo de gestión
    Route::get('/publicaciones', GestionPublicaciones::class)->name('publicaciones.index');
    Route::get('/eventos', GestionEventos::class)->name('eventos.index');
    Route::get('/recursos-digitales', GestionRecursos::class)->name('recursos.index');
    Route::get('/documentos', GestionDocumentos::class)->name('documentos.index');
    Route::get('/material-apoyo', GestionMaterialApoyo::class)->name('material.index');
    Route::get('/secciones', GestionSecciones::class)->name('secciones.index');

     // --- Rutas de Configuración y Categorías ---
    Route::get('/categorias-publicaciones', GestionCategoriasPublicacion::class)->name('categorias.publicacion.index');
    Route::get('/categorias-eventos', GestionCategoriasEvento::class)->name('categorias.evento.index');
    Route::get('/categorias-material', GestionCategoriasMaterial::class)->name('categorias.material.index');

    // --- Rutas de Menús ---
    Route::get('/menus', GestionMenus::class)->name('menus.index');
    Route::get('/menus/{menu}/items', GestionMenuItems::class)->name('menus.items.index');

    Route::get('/recursosorteable', RecursosSortable::class)->name('recursosorteable.index');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
