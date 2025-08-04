<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Magazine</title>
    <!-- Carga de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Fuente Inter para una mejor legibilidad */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Fondo gris claro */
        }
        /* Estilos personalizados para las tarjetas de blog */
        .blog-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .blog-card:hover {
            transform: translateY(-5px); /* Pequeño efecto de elevación al pasar el ratón */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* Sombra más pronunciada */
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Encabezado de la página -->
        <header class="text-center mb-8 sm:mb-12">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4">Nuestro Blog Magazine</h1>
            <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto">Explora nuestros últimos artículos, noticias y guías.</p>
        </header>

        <!-- Sección de Artículos Destacados -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b-2 border-indigo-500 pb-2">Artículos Destacados</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta de Artículo Destacado 1 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/818cf8/ffffff?text=Tecnología" alt="Imagen destacada de tecnología" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-indigo-600 uppercase">Tecnología</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">El futuro de la inteligencia artificial</h3>
                        <p class="mt-3 text-gray-600 text-base">Descubre cómo la IA está transformando el mundo y qué nos depara el futuro.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo Destacado 2 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/f87171/ffffff?text=Salud" alt="Imagen destacada de salud" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-red-600 uppercase">Salud y Bienestar</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Guía completa para una vida saludable</h3>
                        <p class="mt-3 text-gray-600 text-base">Consejos prácticos para mejorar tu bienestar físico y mental.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-red-600 hover:text-red-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo Destacado 3 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/4ade80/ffffff?text=Viajes" alt="Imagen destacada de viajes" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-green-600 uppercase">Viajes</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Los 10 destinos más impresionantes para 2025</h3>
                        <p class="mt-3 text-gray-600 text-base">Inspírate para tu próxima aventura con nuestra selección de lugares increíbles.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-green-600 hover:text-green-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Últimos Artículos -->
        <section>
            <h2 class="text-3xl font-bold text-gray-900 mb-6 border-b-2 border-purple-500 pb-2">Últimos Artículos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta de Artículo 1 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/fbbf24/ffffff?text=Finanzas" alt="Imagen destacada de finanzas" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-yellow-600 uppercase">Finanzas Personales</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Cómo ahorrar dinero de forma inteligente</h3>
                        <p class="mt-3 text-gray-600 text-base">Estrategias efectivas para gestionar tus finanzas y alcanzar tus metas.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-yellow-600 hover:text-yellow-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo 2 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/60a5fa/ffffff?text=Cocina" alt="Imagen destacada de cocina" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-blue-600 uppercase">Cocina</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Recetas rápidas y saludables para el día a día</h3>
                        <p class="mt-3 text-gray-600 text-base">Ideas deliciosas para comer bien sin complicaciones.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-blue-600 hover:text-blue-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo 3 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/a78bfa/ffffff?text=Desarrollo" alt="Imagen destacada de desarrollo personal" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-purple-600 uppercase">Desarrollo Personal</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Hábitos para potenciar tu productividad</h3>
                        <p class="mt-3 text-gray-600 text-base">Descubre cómo pequeños cambios pueden generar grandes resultados.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-purple-600 hover:text-purple-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo 4 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/34d399/ffffff?text=Medio+Ambiente" alt="Imagen destacada de medio ambiente" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-emerald-600 uppercase">Medio Ambiente</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Consejos para un estilo de vida sostenible</h3>
                        <p class="mt-3 text-gray-600 text-base">Pequeñas acciones que contribuyen a un planeta más verde.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-emerald-600 hover:text-emerald-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo 5 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/f472b6/ffffff?text=Arte" alt="Imagen destacada de arte" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-pink-600 uppercase">Arte y Cultura</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Explorando el arte moderno: Una guía para principiantes</h3>
                        <p class="mt-3 text-gray-600 text-base">Sumérgete en el fascinante mundo del arte contemporáneo.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-pink-600 hover:text-pink-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
                <!-- Tarjeta de Artículo 6 -->
                <div class="blog-card bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="https://placehold.co/600x400/94a3b8/ffffff?text=Historia" alt="Imagen destacada de historia" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <span class="text-sm font-semibold text-slate-600 uppercase">Historia</span>
                        <h3 class="mt-2 text-xl font-bold text-gray-900 leading-tight">Momentos clave que cambiaron el curso de la historia</h3>
                        <p class="mt-3 text-gray-600 text-base">Un viaje a través de los eventos más impactantes de la humanidad.</p>
                        <a href="#blog-detail-page" class="mt-4 inline-block text-slate-600 hover:text-slate-800 font-semibold">Leer más &rarr;</a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Pie de página simple -->
    <footer class="bg-gray-800 text-white text-center p-6 mt-12">
        <p>&copy; 2025 Nuestro Blog Magazine. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
