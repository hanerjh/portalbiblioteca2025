<div>
    @section('titulo','Noticias')
    @section('titulo_page','Sección Informativa de Biblioteca')
    @section('desc_page','Mantente al día con las últimas noticias, eventos y anuncios de la biblioteca.')

    <div class="container">
        

        <!-- Filtros de Categorías -->
        <div class="text-center mb-5">
            <button wire:click="clearCategoryFilter" class="btn {{ !$selectedCategory ? 'btn-primary' : 'btn-outline-primary' }} m-1">Todas</button>
            @foreach($categorias as $categoria)
                <button wire:click="filterByCategory('{{ $categoria->slug }}')" class="btn {{ $selectedCategory == $categoria->slug ? 'btn-primary' : 'btn-outline-primary' }} m-1" style="--bs-btn-border-color: {{ $categoria->color }}; --bs-btn-color: {{ $categoria->color }};">
                    {{ $categoria->nombre }}
                </button>
            @endforeach
        </div>

        <!-- Publicación Destacada -->
        @if($featuredPost)
        <div class="card mb-5 shadow-lg border-0">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="{{ $featuredPost->imagen_destacada ? asset('storage/' . $featuredPost->imagen_destacada) : 'https://placehold.co/800x600/6c757d/ffffff?text=Imagen' }}" class="img-fluid rounded-start" alt="Imagen de {{ $featuredPost->titulo }}">
                </div>
                <div class="col-md-6 d-flex flex-column p-4">
                    <div class="card-body">
                        <span class="badge mb-2" style="background-color: {{ $featuredPost->categoria->color }};">{{ $featuredPost->categoria->nombre }}</span>
                        <h2 class="card-title">{{ $featuredPost->titulo }}</h2>
                        <p class="card-text text-muted">{{ $featuredPost->resumen }}</p>
                        <p class="card-text"><small class="text-muted">Por {{ $featuredPost->autor ?? 'Biblioteca' }} - {{ $featuredPost->fecha_publicacion->format('d M, Y') }}</small></p>
                        <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-dark mt-auto">Leer más <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Listado de Publicaciones -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($posts as $post)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <a href="{{ route('blog.show', $post->slug) }}">
                         <img src="{{ $post->imagen_destacada ? asset('storage/' . $post->imagen_destacada) : 'https://placehold.co/600x400/6c757d/ffffff?text=Imagen' }}" class="card-img-top" alt="Imagen de {{ $post->titulo }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <span class="badge mb-2 align-self-start" style="background-color: {{ $post->categoria->color }};">{{ $post->categoria->nombre }}</span>
                        <h5 class="card-title">{{ $post->titulo }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ $post->resumen }}</p>
                        <p class="card-text"><small class="text-muted">{{ $post->fecha_publicacion->format('d M, Y') }}</small></p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-secondary mt-auto">Leer más</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    No hay publicaciones disponibles en esta categoría.
                </div>
            </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>

    </div>
</div>
