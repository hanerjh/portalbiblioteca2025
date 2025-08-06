<div>
    @section('titulo','Noticias')
    @section('titulo_page','Sección Informativa de Biblioteca')
    @section('desc_page','Mantente al día con las últimas noticias, eventos y anuncios de la biblioteca.')

    <div class="container">
        

        <!-- Filtros de Categorías -->
        
        <div class="text-center my-5">
            <p class="lead">Filtra las publicaciones por la categoria de interes </p>
            <button wire:click="clearCategoryFilter" class="btn {{ !$selectedCategory ? 'btn-outline-secondary' : 'btn-outline-secondary' }}">Todas</button>
            @foreach($categorias as $categoria)
                {{-- <button wire:click="filterByCategory('{{ $categoria->slug }}')" class="btn {{ $selectedCategory == $categoria->slug ? 'btn-primary' : 'btn-outline-primary' }} mt-5" style="--bs-btn-border-color: {{ $categoria->color }}; --bs-btn-color: {{ $categoria->color }};"> --}}
                <button wire:click="filterByCategory('{{ $categoria->slug }}')" class="btn  btn-outline-secondary">
                    {{ $categoria->nombre }}
                </button>
            @endforeach
        </div>

        

        <!-- Listado de Publicaciones -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($posts as $post)
            <div class="col">
                <div class="card h-100 border-1">
                    <a href="{{ route('blog.show', $post->slug) }}">
                         <img src="{{ $post->imagen_destacada ? asset('storage/' . $post->imagen_destacada) : 'https://placehold.co/600x400/6c757d/ffffff?text=Imagen' }}" style="height: 400px; object-fit: cover;" class="card-img-top" alt="Imagen de {{ $post->titulo }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        {{-- <span class="badge mb-2 align-self-start" style="border: 1px solid {{ $post->categoria->color }}; color:{{ $post->categoria->color }};">{{ $post->categoria->nombre }}</span> --}}
                        <span class="badge bg-success mb-2 align-self-start">{{ $post->categoria->nombre }}</span>
                        <h5 class="card-title">{{ $post->titulo }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ $post->resumen }}</p>
                        <p class="card-text"><small class="text-muted">{{ $post->fecha_publicacion->format('d M, Y') }}</small></p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-success mt-auto">Leer más</a>
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
