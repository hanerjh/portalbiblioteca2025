<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administración - Biblioteca</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('css')
    @vite(['resources/assets/compiled/css/app.css', 
        'resources/assets/compiled/css/app-dark.css',
        //'resources/assets/extensions/summernote/summernote-lite.css',
        //'resources/assets/compiled/css/form-editor-summernote.css',
        'resources/assets/compiled/js/app.js',
        'resources/assets/extensions/jquery/jquery.min.js',
        'resources/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js',
        'resources/assets/extensions/parsleyjs/parsley.min.js',
        'resources/assets/static/js/pages/parsley.js',
        'resources/assets/static/js/initTheme.js',
        'resources/assets/static/js/components/dark.js',
        'resources/assets/extensions/summernote/summernote-lite.min.js',
        'resources/assets/static/js/pages/summernote.js',
         'resources/assets/static/js/jquery-ui.min.js',
        
        ])
    @livewireStyles
</head>
<body>

<div class="d-flex">
    <!-- Sidebar de Navegación -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; min-height: 100vh;">
        <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="bi bi-book-half me-2 fs-4"></i>
            <span class="fs-4">Biblioteca Admin</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('publicaciones.index') }}" class="nav-link text-white {{ request()->routeIs('publicaciones.index') ? 'active' : '' }}">
                    <i class="bi bi-newspaper me-2"></i> Publicaciones
                </a>
            </li>
            <li>
                <a href="{{ route('eventos.index') }}" class="nav-link text-white {{ request()->routeIs('eventos.index') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event me-2"></i> Eventos
                </a>
            </li>
            <li>
                <a href="{{ route('recursos.index') }}" class="nav-link text-white {{ request()->routeIs('recursos.index') ? 'active' : '' }}">
                    <i class="bi bi-hdd-stack me-2"></i> Recursos Digitales
                </a>
            </li>
            <li>
                <a href="{{ route('documentos.index') }}" class="nav-link text-white {{ request()->routeIs('documentos.index') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text me-2"></i> Documentos
                </a>
            </li>
            <li>
                <a href="{{ route('material.index') }}" class="nav-link text-white {{ request()->routeIs('material.index') ? 'active' : '' }}">
                   <i class="bi bi-play-btn me-2"></i> Material de Apoyo
                </a>
            </li>
             <li>
                <a href="{{ route('secciones.index') }}" class="nav-link text-white {{ request()->routeIs('secciones.index') ? 'active' : '' }}">
                   <i class="bi bi-layout-text-sidebar-reverse me-2"></i> Secciones Web
                </a>
            </li>
            <hr>
             <li>
                <a href="#config-submenu" data-bs-toggle="collapse" class="nav-link text-white">
                     <i class="bi bi-gear me-2"></i> Configuración
                </a>
                <div class="collapse" id="config-submenu">
                    <ul class="nav flex-column ms-4">
                        <li><a href="{{ route('menus.index') }}" class="nav-link text-white small {{ request()->routeIs('menus.*') ? 'active' : '' }}">Gestión de Menús</a></li>
                        <li><a href="{{ route('categorias.publicacion.index') }}" class="nav-link text-white small {{ request()->routeIs('categorias.publicacion.index') ? 'active' : '' }}">Cat. Publicaciones</a></li>
                        <li><a href="{{ route('categorias.evento.index') }}" class="nav-link text-white small {{ request()->routeIs('categorias.evento.index') ? 'active' : '' }}">Cat. Eventos</a></li>
                        <li><a href="{{ route('categorias.material.index') }}" class="nav-link text-white small {{ request()->routeIs('categorias.material.index') ? 'active' : '' }}">Cat. Material Apoyo</a></li>
                        
                    </ul>
                </div>
            </li>
        </ul>
        <hr>
        <!-- Dropdown de Usuario (ejemplo) -->
        <div>
            <a href="#" class="d-flex align-items-center text-white text-decoration-none">
                <i class="bi bi-person-circle fs-4 me-2"></i>
                <strong>Administrador</strong>
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <main class="w-100 p-4" style="background-color: #f8f9fa;">
         @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{ $slot }}
    </main>
</div>

<!-- Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}

@livewireScripts
@stack('script')


</body>
</html>
