<div>
    @section('titulo','Noticias')
    @section('titulo_page','Sección Informativa de Biblioteca')
    @section('desc_page','Mantente al día con las últimas noticias, eventos y anuncios de la biblioteca.')
    <div class="container mt-5">
        <div class="row">
            <!-- Contenido principal de la noticia -->
            <div class="col-lg-8">
                <article>
                    <!-- Cabecera de la noticia -->
                    
                        <!-- Título -->
                        <h1 class="fw-bolder mb-1">{{ $post->titulo }}</h1>
                        <!-- Meta información -->
                        <div class="text-muted fst-italic mb-2">
                            Publicado el {{ $post->fecha_publicacion->format('d \d\e F \d\e Y') }} por {{ $post->autor ?? 'Biblioteca' }}
                        </div>
                        <!-- Categoría -->
                        <a class="badge text-decoration-none" href="{{ route('blog.index', ['categoria' => $post->categoria->slug]) }}" style="background-color: {{ $post->categoria->color }};">
                            {{ $post->categoria->nombre }}
                        </a>
                  
                    <!-- Imagen destacada -->
                    <figure class="mb-4">
                        <img class="img-fluid rounded" src="{{ $post->imagen_destacada ? asset('storage/' . $post->imagen_destacada) : 'https://placehold.co/900x400/6c757d/ffffff?text=Imagen' }}" alt="Imagen de {{ $post->titulo }}" />
                    </figure>
                    <!-- Contenido de la noticia -->
                    <section class="mb-5 fs-5">
                        {!! nl2br(e($post->contenido)) !!}
                    </section>
                </article>
            </div>
            <!-- Barra lateral -->
            <div class="col-lg-4">
                <!-- Noticias recientes -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white"><strong>Noticias Recientes</strong></div>
                    <div class="card-body">
                        @foreach($recentPosts as $recent)
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <img src="{{ $recent->imagen_destacada ? asset('storage/' . $recent->imagen_destacada) : 'https://placehold.co/100x100/6c757d/ffffff?text=Img' }}" alt="Imagen de {{ $recent->titulo }}" width="70" height="70" class="rounded">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><a href="{{ route('blog.show', $recent->slug) }}" class="text-decoration-none text-dark">{{ $recent->titulo }}</a></h6>
                                <small class="text-muted">{{ $recent->fecha_publicacion->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
