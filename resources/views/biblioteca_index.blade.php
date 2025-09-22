<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Unipacífico - Template</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>


    @vite(['resources/css/custom.css', 'resources/css/style.css'])
    @livewireStyles
</head>

<body>

<div id="carouselExampleAutoplaying" class="carousel slide cabecera" data-bs-ride="carousel">
    <header class="bg-light border-bottom">
            <nav class="navbar navbar-expand-lg navbar-light container">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="https://www.unipacifico.edu.co/storage/wlqYSgBs.png" alt="Biblioteca Unipacífico Logo"
                            height="40">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Biblioteca</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Servicios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Servicios para Egresados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Publicaciones Unipacífico</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Preguntas frecuentes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contáctenos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
  <div class="carousel-inner">
     @foreach ($publicaciones as $publicacion)
     
    <div class="carousel-item {{ $loop->index === 0 ? 'active' : '' }}">        
      <img src="{{ asset('storage/'.$publicacion->imagen_destacada ?? 'frontend_img/CAMPUS.jpg') }}" class="d-block w-100 img-cover" height="500px" alt="...">
      <div class="carousel-caption d-none d-md-block z-3">
        <div class="container ">
                    <div class="row align-items-center">
                        <!-- Announcement Text -->
                        <div class="col-lg-6  mb-lg-0 mt-5">
                            <div class="badge bg-secondary-green mb-2 p-2">{{ strtoupper($publicacion->created_at->translatedFormat('j M')) }}</div>
                            <h1 class="fw-bold">{{$publicacion->titulo}}</h1>
                            <a href="noticias/{{$publicacion->slug}}" class="btn btn-light btn-lg mt-3">
                                Ver más <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                        <!-- Video Placeholder & QR Code -->
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-center">
                                <!-- Video Placeholder -->
                                @if(!empty($publicacion->url_video) && $publicacion->activar_video)
                                    
                                        <iframe width="460" height="250" mb-5 src="https://www.youtube.com/embed/{{ $publicacion->url_video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                  
                                @endif
                                <br>
                                @if(!empty($publicacion->url_audio) && $publicacion->activar_audio)
                                    <audio controls>
                                        <source src="https://unipacificoeduco-my.sharepoint.com/personal/haner_unipacifico_edu_co/Documents/BIBLIOTECA/{{ $publicacion->url_audio }}" type="audio/mpeg">
                                        Tu navegador no soporta el elemento de audio.
                                    </audio>
                                @endif
                                <!-- QR Code -->
                                <div class="qrcode ms-3">

                                    {!! QrCode::size(80)->generate('https://tusitio.com') !!}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    </div>
    @endforeach
   </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



    <!-- Recursos Clave Section -->
    <section class="m-2 bg-primary-green text-white recursos-claves">
        <div class="container">
            <div class="row align-items-center py-4">
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <h2 class="fw-bold">Recursos clave</h2>
                    <p>Explora los servicios que más te interesan de nuestra biblioteca
                    </p>
                </div>
                <div class="col-lg-9">
                    <div class="row g-3 opt-rec-clave">
                        @foreach ($menu as $menuRecursos )
                            @if ($menuRecursos->menu_id==4)
                            <div class="col-md-3" ><a href="#"
                                class="btn  w-100  text-secundary fw-semibold">{{$menuRecursos->titulo}}</a></div> 
                            @endif
                            
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plataformas Digital Section -->
    <section  class="py-5 bg-light" style="margin-top: -100px">
        <div class="container">
            <h2 class="text-center fw-bold mb-2">Plataformas Digital</h2>
            <p class="text-center text-muted mb-5">Conéctate con nuestras plataformas para la gestión del conocimiento.
            </p>
            <div class="row g-4 justify-content-center cont-Platform">

                <!-- Catálogo en Línea -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card platf-card text-center shadow-sm w-100 cardCata">
                        <div class="card-body d-flex flex-column mt-5">
                            <i class="bi bi-book-half display-6 text-primary-black mb-3"></i>
                            <h5 class="card-title fw-bold">CATÁLOGO EN LÍNEA</h5>
                            <p class="card-text small  flex-grow-1">Consulte todo el acervo bibliográfico disponible en
                                la biblioteca, a través del catálogo público de acceso en línea.</p>
                            <a href="#" class="btn btn-primary-green text-white mt-auto">Ingresar</a>
                        </div>
                    </div>
                </div>

                <!-- Repositorio Institucional -->
                <div class="col-md-6 col-lg-3 d-flex ">
                    <div class="card platf-card text-center shadow-sm w-100 cardRepo">
                        <div class="card-body d-flex flex-column mt-5">
                            <i class="bi bi-database-fill-gear display-6 text-primary-black"></i>
                            <h5 class="card-title fw-bold">REPOSITORIO INSTITUCIONAL</h5>
                            <p class="card-text small flex-grow-1">Consulte la producción académica, científica e
                                Investigativa de la Universidad del Pacífico a través del repositorio Institucional.</p>
                            <a href="#" class="btn btn-dark-blue mt-auto">Ingresar</a>
                        </div>
                    </div>
                </div>

                <!-- Recursos Digitales -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card platf-card text-center shadow-sm w-100 cardRegDig">
                        <div class="card-body d-flex flex-column mt-5">
                            <i class="bi bi-laptop display-6 text-primary-black mb-3"></i>
                            <h5 class="card-title fw-bold">RECURSOS DIGITALES</h5>
                            <p class="card-text small text-muted flex-grow-1">Accede a los recursos digitales de la
                                Biblioteca, como bases de datos, revistas y libros electrónicos, para apoyar tu búsqueda
                                de información académica y científica</p>
                            <a href="#" class="btn btn-dark-blue text-white mt-auto">Ingresar</a>
                        </div>
                    </div>
                </div>
                <!-- Publicaciones -->
                <div class="col-md-6 col-lg-3 d-flex">
                    <div class="card platf-card text-center shadow-sm w-100 cardPub">
                        <div class="card-body d-flex flex-column mt-5">
                            <i class="bi bi-journal-text display-6 text-primary-black mb-3"></i>
                            <h5 class="card-title fw-bold">PUBLICACIONES</h5>
                            <p class="card-text small text-muted flex-grow-1">Accede a los recursos digitales de la
                                Biblioteca, como bases de datos, revistas y libros electrónicos, para apoyar tu búsqueda
                                de información académica y científica</p>
                            <a href="#" class="btn btn-primary-green text-white mt-auto">Ingresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Noticias Section -->
    <section class="container py-5">

            <div class="row ">

                <div class="col-lg-9">
                    <div class="col-12 my-0">
                        <h2 class="text-center fw-bold mb-2">Noticias Biblioteca Unipacífico</h2>
                        <p class="text-center text-muted mb-4">Infórmate sobre las últimas noticias, avisos importantes
                            y eventos de la Biblioteca</p>
                    </div>
                    <div class="cont-noticia">
                        @foreach ($publicaciones as $pub )
                       
                        <div class="{{ $loop->index === 0 ? 'noti1' : '' }}">
                            <div class="card news-card shadow-sm h-100">
                                <img src="storage/{{ $pub->imagen_destacada ?? 'frontend_img/CAMPUS.jpg' }}"
                                    class="card-img-top" alt="Noticia 2">
                                <div class="card-img-overlay">
                                    <h5 class="card-title "><a href="#">{{ ucfirst($pub->titulo)}}</a></h5>
                                </div>
                                <a href="noticias/{{ $pub->slug }}" class="stretched-link-icon"><i
                                        class="bi bi-arrow-right-circle-fill"></i></a>
                            </div>
                        </div>
                        @endforeach
                        <a href="#" style="text-decoration: none; color:black;"> <i class="bi bi-plus-square"></i> Ver más publicaciones</a>
                       
                    </div>

                </div>
                <!-- Haz tu solicitud -->
                <aside class="col-lg-3 requests-list">

                    <div>

                        <h4 class="fw-bold mb-4">
                            <!-- <i class="fi fi-ss-email-pending "></i> -->
                            <img src="personal.png" width="64px" alt="">
                            Solicitudes Bibliotecas
                        </h4>
                        <p>Haz tus solicitudes de Biblioteca facilmente</p>
                    </div>
                    <ul class="list-unstyled ">

                        @foreach ($menu as $menuitem)
                            
                            @if ($menuitem->menu_id==3)
                                <li class="mb-1 d-flex align-items-center" >
                                    <i class="{{ $menuitem->icono }}"></i>
                                    <!-- <i class="bi bi-people-fill fs-5 mx-2"></i> -->
                                    <span><a href="{{ $menuitem->url }}"> {{$menuitem->titulo}}</a></span>
                                </li>
                                    
                            @endif
                            
                        @endforeach
                        
                    </ul>
                </aside>
            </div>


        </div>
        </div>
    </section>

    <!-- Quick Access & Requests Section -->
    <section class="py-1 ">
        <div class="container">
            <div class="row g-5">
                <!-- Acceso Rápido -->
                <div class="col-lg-12 bg-light p-5">
                    <h3 class="fw-bold">Acceso rápido</h3>
                    <p class="text-muted mb-4">Ingresa a las principales plataformas de la Biblioteca y del campus con
                        un clic</p>
                    <div class="d-flex flex-wrap align-items-center gap-4">

                        @foreach ( $recursos as $recurso )
                            <a href="{{ $recurso->url }}"><img src="storage/{{ $recurso->imagen_recurso }}"
                                alt="{{ $recurso->titulo }}" style="height: 40px;"></a>
                        @endforeach

                        <a href="#"><img src="{{ url('frontend_img/Turnitin_logo_(2021).svg.png') }}"
                                alt="Turnitin Logo" style="height: 40px;"></a>
                        <a href="#"><img src="frontend_img/ebsco_1.png" alt="EBSCOhost Logo"
                                style="height: 40px;"></a>
                        <a href="#"><img src="frontend_img/elibro.png" alt="eLibro Logo"
                                style="height: 40px;"></a>
                        <a href="#"><img src="frontend_img/OverDrive_logo.png" alt="OverDrive Logo"
                                style="height: 30px;"></a>
                        <a href="#"><img src="frontend_img/img-header-libby.png" alt="Libby Logo"
                                style="height: 40px;"></a>
                        <!-- Add more logos as needed -->
                        <a href="#"><img src="frontend_img/logo-moodle.png" alt="Moodle Logo"
                                style="height: 50px;"></a>
                        <a href="#"><img src="frontend_img/Outlook-Emblem.png" alt="Outlook Logo"
                                style="height: 50px;"></a>
                        <a href="#"><img src="frontend_img/header1.jpg" alt="Academusoft Logo"
                                style="height: 50px;"></a>

                    </div>
                </div>

                <!-- <div class="col-4 bg-light">
                  
             <div class="pt-4">
                <h3 class="fw-bold mb-4 text-center">Plataformas Académicas</h3>
               <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
                    <a href="#"><img src="logo-moodle.png" alt="Moodle Logo" style="height: 50px;"></a>
                   <a href="#"><img src="Outlook-Emblem.png" alt="Outlook Logo" style="height: 50px;"></a>
                    <a href="#"><img src="header1.jpg" alt="Academusoft Logo" style="height: 50px;"></a>
                
               </div>
           </div> -->

            </div>


        </div>
    </section>

    <!-- Novedades Bibliográficas Section -->
    <section class="py-5 mt-4 bg-light ">
        <div class="container">
            <h2 class="text-center fw-bold mb-2">Novedades Bibliográficas</h2>
            <p class="text-center text-muted mb-5">Conoce las últimas incorporaciones a nuestro catálogo bibliográfico
            </p>
            <div class="row g-4">


                @isset($data)
                        @forelse ($data as $datakoha)
                    <div id="novedadesbibliograficas" class="col-6 col-md-4 col-lg-2">
                       <div class="card h-100 border-0">
                            <a href="https://catalogo.unipacifico.edu.co/cgi-bin/koha/opac-detail.pl?biblionumber={{$datakoha[0]}}"
                                target="blank" data-toggle="tooltip" data-placement="top" title="{{$datakoha[1]}}"><img
                                    class="card-img-top shadow"
                                    src="https://catalogo.unipacifico.edu.co/cgi-bin/koha/opac-image.pl?thumbnail=1&biblionumber={{$datakoha[0]}}"
                                    alt="{{$datakoha[1]}}"></a>
                            {{-- <small class="text-white ">{{$datakoha[1]}}</small> --}}
                        </div>
                         </div>
                        @empty
                           <p>No hay conexión</p>
                        @endforelse
                    @endisset


                
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-green text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <!-- University Info -->
                <div class="col-md-5 mb-4 mb-md-0">
                    <img src="https://www.unipacifico.edu.co/storage/wlqYSgBs.png" alt="Universidad del Pacífico Logo"
                        class="mb-3" style="height: 50px;">
                    <p class="small">La Universidad del Pacífico es una institución de educación superior sujeta a
                        inspección y vigilancia por el Ministerio de Educación Nacional.</p>
                    <p class="small mb-1">Universidad del Pacífico - Buenaventura - Valle del Cauca - Colombia Km 13
                        vía al Aeropuerto Barrio el Triunfo Campus Universitario - PBX. (2) 2405555 - Cod. Postal:
                        764503</p>
                    <p class="small">Email: <a href="mailto:info@unipacifico.edu.co"
                            class="text-white text-decoration-none">info@unipacifico.edu.co</a></p>
                </div>

                <!-- Institutional Media -->
                <div class="col-md-3 offset-md-1 mb-4 mb-md-0">
                    <h5 class="mb-3 fw-semibold">Medios Institucionales</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled small footer-links">
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Unipacífico</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Biblioteca</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Bienestar</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Egresados</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Servicios</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Noticias</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Contactenos</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled small footer-links">
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Catálogo
                                        en Linea</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Bases de
                                        Datos</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Repositorio</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Academusoft</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Avas</a>
                                </li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Canal
                                        Yubarta</a></li>
                                <li class="mb-2"><a href="#"
                                        class="text-white text-decoration-none">Unipacífico Estéreo</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Opening Hours -->
                <div class="col-md-3">
                    <h5 class="mb-3 fw-semibold">Horario de atención</h5>
                    <p class="small mb-2"><strong>Biblioteca del Campus Universitario:</strong><br> Lunes a Viernes de
                        7:00 A.M. a 8:30 P.M. y Sábados de 8:00 A.M. a 2:00 P.M.</p>
                    <p class="small"><strong>Biblioteca Ciudadela Colpuertos:</strong><br> Lunes a Viernes 9:00 A.M. a
                        9:00 P.M, Sábados de 8:00 A.M. a 2:00 P.M.</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center small text-white-50">
                © 2024 Biblioteca Unipacífico. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
       const myCarouselElement = document.querySelector('#carouselExampleAutoplaying')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
    interval: 3000,
    touch: false
    });
// Capturas la sección a modificar
  const heroSection = document.querySelector('.hero-section');

  // Escuchas el evento cuando cambia el slide
  myCarouselElement.addEventListener('slid.bs.carousel', function () {
    const activeItem = myCarouselElement.querySelector('.carousel-item.active');
    const newBg = activeItem.getAttribute('data-bg');

    if (newBg && heroSection) {
      heroSection.style.backgroundImage = `url('${newBg}')`;
    }
  });

  // Establecer fondo inicial
  const firstItem = myCarouselElement.querySelector('.carousel-item.active');
  if (firstItem && heroSection) {
    const initialBg = firstItem.getAttribute('data-bg');
    heroSection.style.backgroundImage = `url('${initialBg}')`;
  }
    
    </script>

    
</body>

</html>
