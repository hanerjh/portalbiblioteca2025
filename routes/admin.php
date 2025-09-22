<?php
use App\Livewire\Admin\GestionAreaConocimiento;
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
use App\Livewire\Admin\GestionTipoUsuario;
use App\Livewire\Admin\GestionProgramaAcademico;

use App\Livewire\Admin\CreateLayout;
use App\Livewire\Admin\CreatePages;
use App\Livewire\Admin\GestionUsuarios;
use Illuminate\Support\Facades\Auth;

// Asume que tienes un layout de administración y un middleware de autenticación 'auth'

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/publicaciones', function () {
        return view('admin.publicaciones'); // Vista del panel de administración
    })->name('publicaciones.index');

    
});

Route::middleware(['auth'])->group(function () {
    // Rutas para cada módulo de gestión
    Route::get('/publicaciones', GestionPublicaciones::class)->name('publicaciones.index');
    Route::get('/eventos', GestionEventos::class)->name('eventos.index');
    Route::get('/recursos-digitales', GestionRecursos::class)->name('recursos.index');
    Route::get('/documentos', GestionDocumentos::class)->name('documentos.index');
    Route::get('/material-apoyo', GestionMaterialApoyo::class)->name('material.index');
    Route::get('/secciones', GestionSecciones::class)->name('secciones.index');
    Route::get('/recursosorteable', RecursosSortable::class)->name('recursosorteable.index');

     // --- Rutas de Configuración y Categorías ---
    Route::get('/categorias-publicaciones', GestionCategoriasPublicacion::class)->name('categorias.publicacion.index');
    Route::get('/categorias-eventos', GestionCategoriasEvento::class)->name('categorias.evento.index');
    Route::get('/categorias-material', GestionCategoriasMaterial::class)->name('categorias.material.index');
    Route::get('/categorias-usuario', GestionTipoUsuario::class)->name('categorias.tipousuario.index');
    Route::get('/area-conocimiento', GestionAreaConocimiento::class)->name('areaconocimiento.index');
    Route::get('/programa-academico', GestionProgramaAcademico::class)->name('programa.academico.index');

    // --- NUEVA RUTA DE GESTIÓN DE USUARIOS ---
    Route::get('/usuarios', GestionUsuarios::class)->name('usuarios');
    
    // creacion de paginas y layouts
    Route::get('/layouts-create', CreateLayout::class)->name('createlayout.index');
    Route::get('/pages-create', CreatePages::class)->name('createpages.index');

    // --- Rutas de Menús ---
    Route::get('/menus', GestionMenus::class)->name('menus.index');
    Route::get('/menus/{menu}/items', GestionMenuItems::class)->name('menus.items.index');
});


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
