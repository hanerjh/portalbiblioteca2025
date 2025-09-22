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


<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Biblioteca') }}</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                    @else
                        <li class="nav-item">
                             <a class="nav-link" href="{{ route('publicaciones') }}">Panel de Administración</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar Sesión
                                </a>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        {{ $slot }}
    </main>

    {{-- ... resto del archivo ... --}}
</body>


</body>
</html>
