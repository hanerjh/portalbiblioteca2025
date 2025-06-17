<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Categorías de Material de Apoyo</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nueva Categoría</button>
        </div>
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Buscar por nombre...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ Str::limit($categoria->descripcion, 50) }}</td>
                            <td><span class="badge {{ $categoria->activa ? 'bg-success' : 'bg-secondary' }}">{{ $categoria->activa ? 'Activa' : 'Inactiva' }}</span></td>
                            <td class="text-end">
                                <button wire:click="edit({{ $categoria->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $categoria->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">No hay categorías para mostrar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">{{ $categorias->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $categoria_id ? 'Editar Categoría' : 'Nueva Categoría' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" wire:model="nombre" class="form-control">
                            @error('nombre') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                             <label for="icono" class="form-label">Icono (Ej: bi bi-collection-play)</label>
                            <input type="text" wire:model="icono" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea wire:model="descripcion" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="activaSwitchMaterial" wire:model="activa">
                            <label class="form-check-label" for="activaSwitchMaterial">Activa</label>
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
