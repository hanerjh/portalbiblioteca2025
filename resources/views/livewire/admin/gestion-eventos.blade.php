<div>
      @include('partials.includes')
    {{-- La estructura de la vista es muy similar a la de Publicaciones --}}
    {{-- Simplemente cambia los títulos, la tabla y los campos del formulario modal --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Gestión de Eventos</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo
                Evento</button>
        </div>
        <div class="card-body" wire:ignore>
            {{-- Barra de búsqueda --}}
            {{-- <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3"
                placeholder="Buscar por título..."> --}}
            {{-- Tabla de eventos --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover"  id="table1">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Fecha de Inicio</th>
                            <th>Modalidad</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($eventos as $evento)
                            <tr>
                                <td>{{ $evento->titulo }}</td>
                                <td>{{ $evento->categoria->nombre }}</td>
                                <td>{{ $evento->fecha_inicio->format('d/m/Y H:i') }}</td>
                                <td>{{ ucfirst($evento->modalidad) }}</td>
                                <td>
                                    <span
                                        class="badge {{ $evento->estado == 'publicado' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($evento->estado) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button wire:click="edit({{ $evento->id }})" class="btn btn-sm btn-info"
                                        title="Editar"><i class="bi bi-pencil"></i></button>
                                    <button wire:click="delete({{ $evento->id }})" wire:confirm="¿Estás seguro?"
                                        class="btn btn-sm btn-danger" title="Eliminar"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay eventos para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $eventos->links() }}</div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade @if ($isOpen) show @endif"
        style="display: @if ($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $evento_id ? 'Editar Evento' : 'Nuevo Evento' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    {{-- Formulario con campos de evento: titulo, slug, categoria, fecha_inicio, fecha_fin, modalidad, estado, etc. --}}
                    <form>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título del Evento</label>
                            <input type="text" wire:model.live="titulo" class="form-control">
                            @error('titulo')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select wire:model="categoria_id" class="form-select">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="modalidad" class="form-label">Modalidad</label>
                                <select wire:model="modalidad" class="form-select">
                                    <option value="presencial">Presencial</option>
                                    <option value="virtual">Virtual</option>
                                    <option value="hibrido">Híbrido</option>
                                </select>
                                @error('modalidad')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha y Hora de Inicio</label>
                                <input type="datetime-local" wire:model="fecha_inicio" class="form-control">
                                @error('fecha_inicio')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_fin" class="form-label">Fecha y Hora de Fin (Opcional)</label>
                                <input type="datetime-local" wire:model="fecha_fin" class="form-control">
                                @error('fecha_fin')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lugar" class="form-label">Lugar / Plataforma</label>
                            <input type="text" wire:model="lugar" class="form-control"
                                placeholder="Ej: Auditorio principal o Zoom">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción Corta</label>
                            <textarea wire:model="descripcion" class="form-control" rows="3"></textarea>
                        </div>
                    <div class="row">
                   

                        <div class="col-md-6 mb-3">
                                <label for="archivo" class="form-label">Archivo</label>
                                <input type="file" wire:model="archivo" class="form-control" id="archivo">
                                <div wire:loading wire:target="archivo" class="text-primary small mt-1">Cargando...</div>
                                @if ($evento_id)
                                    <small class="form-text text-muted">Dejar en blanco para no modificar el archivo
                                        actual.</small>
                                @endif
                                @error('archivo')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                        </div>
                            <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select wire:model="estado" class="form-select" id="estado">
                                <option value="Borrador">Borrador</option>
                                <option value="Publicado">Publicado</option>
                                <option value="Archivado">Archivado</option>
                            </select>
                            @error('estado')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade @if ($isOpen) show @endif"
        style="display: @if ($isOpen) block @else none @endif;"></div>
</div>
