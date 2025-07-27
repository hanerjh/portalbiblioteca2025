

    <div class="container my-4 my-md-5">
        <div class="row g-4">

            <!-- Columna de Filtros (Izquierda) -->
            <aside class="col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold text-dark filter-header ps-2 mb-4">BÚSQUEDA DE RECURSOS DIGITALES</h2>
                        <a href="#" id="clear-filters" class="small text-secondary text-decoration-none">LIMPIAR BÚSQUEDA</a>
                        
                        <div class="mt-4">
                            <label for="search-input" class="fw-semibold text-dark small mb-2">BUSCADOR</label>
                            <div class="input-group">
                                <input type="text" id="search-input"  wire:model.live.debounce.500ms="searchName" placeholder="Palabra clave" class="form-control">
                                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="fw-semibold text-dark small mb-2">POR ORDEN ALFABÉTICO</h3>
                            <div class="card-body  d-grid gap-1"  style="grid-template-columns: repeat(6, 1fr);">
                                @foreach(range('A', 'Z') as $letter)
                                    <a href="#" wire:click.prevent="setLetter('{{ $letter }}')" class="btn btn-outline-secondary alpha-btn {{ $searchLetter == $letter ? 'active' : '' }}">{{ $letter }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="fw-semibold text-dark small mb-2">POR FACULTAD</h3>
                            <div id="faculty-filter" class="d-flex flex-column gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="administracion-empresas" id="fac1">
                                    <label class="form-check-label small" for="fac1"><span class="dot" style="background-color: #3b82f6;"></span>Administración de Empresas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="administracion-empresas-turisticas" id="fac2">
                                    <label class="form-check-label small" for="fac2"><span class="dot" style="background-color: #a855f7;"></span>Adm. Empresas Turísticas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ciencias-educacion" id="fac3">
                                    <label class="form-check-label small" for="fac3"><span class="dot" style="background-color: #f97316;"></span>Ciencias de la Educación</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="ciencias-sociales-humanas" id="fac4">
                                    <label class="form-check-label small" for="fac4"><span class="dot" style="background-color: #ef4444;"></span>Ciencias Sociales y Humanas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="comunicacion-social-periodismo" id="fac5">
                                    <label class="form-check-label small" for="fac5"><span class="dot" style="background-color: #14b8a6;"></span>Comunicación Social</label>
                                </div>
                            </div>
                        </div>

                         <!-- Filtro por Tipo de Recurso -->
                         <div class="mt-4">
                            <h3 class="fw-semibold text-dark small mb-2">TIPO DE RECURSIS</h3>
                            <div id="faculty-filter" class="d-flex flex-column gap-2">
                                 @foreach($tipos_recurso as $tipo)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $tipo->id }}" id="tipo_{{ $tipo->id }}" wire:model.live="selectedTipos">
                                    <label class="form-check-label small" for="tipo_{{ $tipo->id }}"><span class="dot" style="background-color: #3b82f6;"></span>{{ $tipo->nombre }}</label>
                                </div>
                               @endforeach
                            </div>
                        </div>

                         <!-- Filtro por Área de Conocimiento -->
                            <div class="mt-4">
                            <h3 class="fw-semibold text-dark small mb-2">POR AREA DE CONOCMIENTO</h3>
                            <div id="faculty-filter" class="d-flex flex-column gap-2">
                                 @foreach($areas_conocimiento as $area)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $area->id }}" id="area_{{ $area->id }}" wire:model.live="selectedAreas">
                                    <label class="form-check-label small" for="area_{{ $area->id }}"><span class="dot" style="background-color: #3b82f6;"></span>{{ $area->nombre }}</label>
                                </div>
                               @endforeach
                            </div>
                        </div>

                        <!-- Filtro por Tipo de Acceso -->
                        <div class="mt-4">
                            <h3 class="fw-semibold text-dark small mb-2">TIPO DE ACCESO</h3>
                            <div id="faculty-filter" class="d-flex flex-column gap-2">
                                 @foreach($selectedAccesos as $acceso)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $acceso->id }}" id="{{ $acceso->id }}" wire:model.live="selectedAccesos">
                                    <label class="form-check-label small" for="{{ $acceso->id }}"><span class="dot" style="background-color: #3b82f6;"></span>{{ $acceso->nombre }}</label>
                                </div>
                               @endforeach
                            </div>
                        </div>

                         <!-- Filtro por Acceso por tipo de estudiante-->
                        <div class="mt-4">
                            <h3 class="fw-semibold text-dark small mb-2">TIPO DE USUARIO</h3>
                            <div id="faculty-filter" class="d-flex flex-column gap-2">
                                 @foreach($tipos_usuario as $usuario)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $usuario->id }}" id="usuario_{{ $usuario->id }}" wire:model.live="selectedUsuarios">
                                    <label class="form-check-label small" for="usuario_{{ $usuario->id }}"><span class="dot" style="background-color: #3b82f6;"></span>{{ $usuario->nombre }}</label>
                                </div>
                               @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </aside>

            <!-- Columna de Contenido (Derecha) -->
            <main class="col-lg-9">
                <div id="resource-list" class="d-flex flex-column gap-4">
                    
                    <!-- Tarjeta de Recurso 1 -->
                    @forelse($recursos as $recurso)
                    <div class="resource-card card shadow-sm" data-title="Acervo Digital Institucional en Seguridad Social - ADISS" data-faculties='["administracion-empresas", "ciencias-sociales-humanas"]'>
                        <div class="card-body p-4">
                            <h3 class="h5 fw-bold text-dark mb-3">{{ $recurso->titulo }}</h3>
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <img src="https://placehold.co/150x60/e9ecef/495057?text=ADISS" alt="Logo ADISS" class="img-fluid" style="max-height: 60px;">
                                </div>
                                <div class="col-md-10">
                                    <p class="small text-secondary">{{ Str::limit($recurso->descripcion, 200) }}</p>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="small text-secondary"><i class="bi bi-unlock-fill me-2"></i>Recurso digital de acceso abierto {{ $recurso->categoria->nombre }}</div>
                                <a href="{{ $recurso->url }}" class="btn btn-brand btn-sm fw-semibold">Ingresar</a>
                            </div>
                            <div class="mt-3 small">
                                <p class="fw-semibold mb-1">Convenciones</p>
                                <div class="d-flex flex-wrap gap-3">
                                    <div>
                                        <p class="text-muted mb-0" style="font-size: 0.7rem;">Facultad</p>
                                        <span class="dot" style="background-color: #3b82f6;"></span>
                                        <span class="dot" style="background-color: #ef4444;"></span>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size: 0.7rem;">Área del conocimiento</p>
                                        <span class="tag bg-info-subtle text-info-emphasis">Adm</span>
                                        <span class="tag bg-danger-subtle text-danger-emphasis">Der</span>
                                        @foreach($recurso->areasConocimiento as $area)
                                            <span class="tag bg-danger-subtle text-danger-emphasis">{{ $area->nombre }}</span>
                                        @endforeach
                                    </div>
                                    <div>
                                        <p class="text-muted mb-0" style="font-size: 0.7rem;">Tipo de perfil</p>
                                        <span class="tag bg-success-subtle text-success-emphasis">Activos</span>
                                        <span class="tag bg-secondary-subtle text-secondary-emphasis">Egresados</span>
                                          @foreach($recurso->tiposUsuario as $usuario)
                                            <span class="tag bg-secondary-subtle text-secondary-emphasis">{{ $usuario->nombre }}</span>
                                          @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     @empty
                    <div class="alert alert-warning text-center">
                        No se encontraron recursos que coincidan con los filtros seleccionados.
                    </div>
                    @endforelse

                    <div class="mt-4">
                        {{ $recursos->links() }}
                    </div>

                   
                   

                </div>
            </main>
        </div>
    </div>
