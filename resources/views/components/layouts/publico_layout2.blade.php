<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Recursos Digitales - Bootstraps</title>
    
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

   .list-group-item:hover{
    background-color: #d1e7dd;
     color: #0a3622;
     border-color: #a3cfbb;
  } 
    </style>
@vite(['resources/css/custom.css', 'resources/css/style.css'])
    @livewireStyles
</head>
<body>
    {{-- Aquí puedes agregar el header/navbar de tu sitio público --}}
@include('partials.menuPrincipal')

<div class="jumbotron jumbotron-fluid py-5 bg-dark text-white">
  <div class="container">
    <h1 class="mt-5">Recursos Electronicos</h1>
    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
  </div>
</div>

   
    
        {{ $slot }}
    

    {{-- Aquí puedes agregar el footer de tu sitio público --}}

  
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $('.collapse').collapse()
    </script>
 <!--    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const alphabetContainer = document.getElementById('alphabet-filter');
            const facultyFilter = document.getElementById('faculty-filter');
            const resourceCards = document.querySelectorAll('.resource-card');
            const clearFiltersButton = document.getElementById('clear-filters');

            // --- Generar botones del alfabeto ---
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
            let alphabetHTML = '';
            alphabet.forEach(letter => {
                alphabetHTML += `<button class="btn btn-outline-secondary alpha-btn" data-letter="${letter}">${letter}</button>`;
            });
            alphabetHTML += `<button class="btn btn-outline-secondary alpha-btn active" data-letter="all" style="grid-column: span 7;">TODAS</button>`;
            alphabetContainer.innerHTML = alphabetHTML;
            const alphabetButtons = alphabetContainer.querySelectorAll('.alpha-btn');

            // --- Función principal de filtrado ---
            function applyFilters() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const activeLetterBtn = alphabetContainer.querySelector('.alpha-btn.active');
                const activeLetter = activeLetterBtn ? activeLetterBtn.dataset.letter : 'all';
                
                const selectedFaculties = Array.from(facultyFilter.querySelectorAll('input:checked')).map(input => input.value);

                resourceCards.forEach(card => {
                    const title = card.dataset.title.toLowerCase();
                    const firstLetter = title.charAt(0).toUpperCase();
                    const faculties = JSON.parse(card.dataset.faculties || '[]');

                    const matchesSearch = searchTerm === '' || title.includes(searchTerm);
                    const matchesLetter = activeLetter === 'all' || firstLetter === activeLetter;
                    const matchesFaculty = selectedFaculties.length === 0 || selectedFaculties.some(sf => faculties.includes(sf));

                    if (matchesSearch && matchesLetter && matchesFaculty) {
                        card.classList.remove('d-none');
                    } else {
                        card.classList.add('d-none');
                    }
                });
            }

            // --- Event Listeners ---
            searchInput.addEventListener('input', applyFilters);

            alphabetContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('alpha-btn')) {
                    alphabetButtons.forEach(btn => btn.classList.remove('active'));
                    e.target.classList.add('active');
                    applyFilters();
                }
            });

            facultyFilter.addEventListener('change', applyFilters);

            clearFiltersButton.addEventListener('click', function(e) {
                e.preventDefault();
                searchInput.value = '';
                
                alphabetButtons.forEach(btn => btn.classList.remove('active'));
                alphabetContainer.querySelector('[data-letter="all"]').classList.add('active');
                
                facultyFilter.querySelectorAll('input:checked').forEach(input => {
                    input.checked = false;
                });

                applyFilters();
            });
            
            // Aplicar filtros al cargar la página por si acaso
            applyFilters();
        });
    </script> -->
@include('partials.footerunpa')
</body>
</html>

