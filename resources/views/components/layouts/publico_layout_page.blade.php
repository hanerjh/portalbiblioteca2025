<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        /* Color principal verde de la imagen */
        :root {
            --brand-green: #5a8228;
            --brand-green-dark: #45631e;
        }
        .filter-header {
            border-left: 4px solid var(--brand-green);
        }
        .btn-brand {
            background-color: var(--brand-green);
            color: white;
            border-color: var(--brand-green);
        }
        .btn-brand:hover {
            background-color: var(--brand-green-dark);
            border-color: var(--brand-green-dark);
        }
        .tag {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 50rem;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .dot {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        .alpha-btn-group .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .form-check-input:checked {
            background-color: var(--brand-green);
            border-color: var(--brand-green);
        }
        .card {
            border: 1px solid #e5e7eb;
        }

        .accordion-button:focus {
    box-shadow: none;
    outline: none;
  }

  
    </style>
@vite(['resources/css/custom.css', 'resources/css/style_page.css'])
    @livewireStyles
</head>
<body>
    {{-- Aquí puedes agregar el header/navbar de tu sitio público --}}
@include('partials.menuPrincipal')


<div class="jumbotron jumbotron-fluid py-5 bg-dark text-white" style="background-image: url('@yield('img')') ;">
  <div class="container">
    <h1 class="mt-5">@yield('titulo_page')</h1>
    <p class="lead">
        @yield('desc_page')
    </p>
  </div>
</div>

<div class="container">
{{ $slot }}
</div>
 
    
       
        
    

    {{-- Aquí puedes agregar el footer de tu sitio público --}}

  
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $('.collapse').collapse()
    </script>
 
@include('partials.footerunpa')
</body>
</html>

