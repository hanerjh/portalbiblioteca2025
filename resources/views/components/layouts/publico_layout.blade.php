<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Biblioteca Digital') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* Estilos personalizados para que coincida con la referencia */
        .filter-card .list-group-item {
            border: none;
            padding: 0.5rem 0;
        }
        .az-filter a {
            color: var(--bs-body-color);
            padding: 0.1rem 0.4rem;
            text-decoration: none;
            border-radius: 0.25rem;
        }
        .az-filter a.active, .az-filter a:hover {
            background-color: var(--bs-primary);
            color: white;
        }
        .resource-card {
            border: 1px solid #e0e0e0;
            border-radius: 0.5rem;
            transition: box-shadow 0.3s ease;
        }
        .resource-card:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>

    @livewireStyles
</head>
<body>
    {{-- Aquí puedes agregar el header/navbar de tu sitio público --}}
    
    <main class="container my-5">
        {{ $slot }}
    </main>

    {{-- Aquí puedes agregar el footer de tu sitio público --}}

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
