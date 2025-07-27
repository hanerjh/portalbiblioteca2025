<div>
    <div class="row">
        <!-- Columna de Filtros (Izquierda) -->
        <div class="col-lg-3">
            <h4 class="mb-3">Filtros</h4>

            <!-- Filtro A-Z -->
            <div class="card mb-4">
                <div class="card-body az-filter d-flex flex-wrap justify-content-center">
                    @foreach(range('A', 'Z') as $letter)
                        <a href="#" wire:click.prevent="setLetter('{{ $letter }}')" class="{{ $searchLetter == $letter ? 'active' : '' }}">{{ $letter }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Buscar por nombre -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Buscar por nombre</strong>
                </div>
                <div class="card-body">
                    <input type="text" wire:model.live.debounce.500ms="searchName" class="form-control" placeholder="Escriba el nombre...">
                </div>
            </div>

            <!-- Filtro por Tipo de Recurso -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Tipo de recurso</strong>
                </div>
                <ul class="list-group list-group-flush filter-card">
                    <li class="list-group-item">
                        @foreach($tipos_recurso as $tipo)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $tipo->id }}" id="tipo_{{ $tipo->id }}" wire:model.live="selectedTipos">
                            <label class="form-check-label" for="tipo_{{ $tipo->id }}">{{ $tipo->nombre }}</label>
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>

            <!-- Filtro por Área de Conocimiento -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Área de conocimiento</strong>
                </div>
                 <ul class="list-group list-group-flush filter-card">
                    <li class="list-group-item">
                        @foreach($areas_conocimiento as $area)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $area->id }}" id="area_{{ $area->id }}" wire:model.live="selectedAreas">
                            <label class="form-check-label" for="area_{{ $area->id }}">{{ $area->nombre }}</label>
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>

            <!-- Filtro por Tipo de Acceso -->
            <div class="card mb-4">
                 <div class="card-header">
                    <strong>Tipo de acceso</strong>
                </div>
                <ul class="list-group list-group-flush filter-card">
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="libre" id="acceso_libre" wire:model.live="selectedAccesos">
                            <label class="form-check-label" for="acceso_libre">Acceso libre</label>
                        </div>
                         <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="suscripcion" id="acceso_suscripcion" wire:model.live="selectedAccesos">
                            <label class="form-check-label" for="acceso_suscripcion">Suscripción</label>
                        </div>
                         <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="restringido" id="acceso_restringido" wire:model.live="selectedAccesos">
                            <label class="form-check-label" for="acceso_restringido">Restringido</label>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Filtro por Acceso para -->
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Acceso para</strong>
                </div>
                 <ul class="list-group list-group-flush filter-card">
                    <li class="list-group-item">
                        @foreach($tipos_usuario as $usuario)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $usuario->id }}" id="usuario_{{ $usuario->id }}" wire:model.live="selectedUsuarios">
                            <label class="form-check-label" for="usuario_{{ $usuario->id }}">{{ $usuario->nombre }}</label>
                        </div>
                        @endforeach
                    </li>
                </ul>
            </div>
            
            <!-- Recursos Destacados -->
            @if($recursos_destacados->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Recursos Destacados</strong>
                </div>
                <div class="card-body">
                    @foreach($recursos_destacados as $destacado)
                        <a href="{{ $destacado->url }}" target="_blank" class="d-block mb-2">
                            {{-- Aquí podrías poner un logo si lo tuvieras en la BD --}}
                            <p class="fw-bold">{{ $destacado->titulo }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- Columna de Resultados (Derecha) -->
        <div class="col-lg-9">
           <!-- <div wire:loading class="d-flex justify-content-center my-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>-->

            <div wire:loading.remove>
                @forelse($recursos as $recurso)
                <div class="card resource-card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title text-primary">{{ $recurso->titulo }}</h5>
                                <p class="card-text">{{ Str::limit($recurso->descripcion, 200) }}</p>
                                
                                <div>
                                    @foreach($recurso->areasConocimiento as $area)
                                        <span class="badge bg-secondary mb-1">{{ $area->nombre }}</span>
                                    @endforeach
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">Acceso para: </small>
                                    @foreach($recurso->tiposUsuario as $usuario)
                                        <i class="bi bi-person-circle" title="{{ $usuario->nombre }}"></i>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-3 text-center align-self-center">
                                <i class="{{ $recurso->categoria->icono ?? 'bi bi-hdd-stack' }} fs-1 text-muted mb-2"></i>
                                <p class="fw-bold">{{ $recurso->categoria->nombre }}</p>
                                <a href="{{ $recurso->url }}" target="_blank" class="btn btn-success w-100">Ingresar</a>
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
        </div>
    </div>
</div>
