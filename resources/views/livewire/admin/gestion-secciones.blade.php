<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Gestión de Secciones Web</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nueva Sección</button>
        </div>
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Buscar por nombre...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th>Plantilla</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($secciones as $seccion)
                        <tr>
                            <td>{{ $seccion->nombre }}</td>
                            <td>/{{ $seccion->slug }}</td>
                            <td>{{ $seccion->template }}</td>
                            <td>
                                <span class="badge {{ $seccion->activa ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $seccion->activa ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $seccion->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $seccion->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No se encontraron secciones.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">{{ $secciones->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $seccion_id ? 'Editar Sección' : 'Nueva Sección' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre de la Sección</label>
                                <input type="text" wire:model="nombre" class="form-control">
                                @error('nombre') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" wire:model="slug" class="form-control bg-light" readonly>
                                @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="contenido" class="form-label">Contenido (HTML permitido)</label>
                            <textarea wire:model="contenido" class="form-control" rows="10"></textarea>
                            <small class="form-text text-muted">Puedes usar un editor WYSIWYG aquí en el futuro.</small>
                        </div>
                         <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="template" class="form-label">Plantilla</label>
                                <input type="text" wire:model="template" class="form-control">
                                @error('template') <span class="text-danger small">{{ $message }}</span> @enderror
                             </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Estado</label>
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" role="switch" id="activaSwitch" wire:model="activa">
                                  <label class="form-check-label" for="activaSwitch">{{ $activa ? 'Activa' : 'Inactiva' }}</label>
                                </div>
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
    <div class="modal-backdrop fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;"></div>
</div>
