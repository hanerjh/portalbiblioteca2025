<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Gestión de Menús</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo Menú</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Posición</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                        <tr>
                            <td>{{ $menu->nombre }}</td>
                            <td>{{ $menu->posicion }}</td>
                            <td><span class="badge {{ $menu->activo ? 'bg-success' : 'bg-secondary' }}">{{ $menu->activo ? 'Activo' : 'Inactivo' }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('menus.items.index', $menu->id) }}" class="btn btn-sm btn-secondary" title="Gestionar Items"><i class="bi bi-list"></i></a>
                                <button wire:click="edit({{ $menu->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $menu->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">No hay menús para mostrar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">{{ $menus->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $menu_id ? 'Editar Menú' : 'Nuevo Menú' }}</h5>
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
                            <label for="posicion" class="form-label">Posición (ej: header, footer)</label>
                            <input type="text" wire:model="posicion" class="form-control">
                             @error('posicion') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                           <textarea wire:model="descripcion" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="activoSwitchMenu" wire:model="activo">
                            <label class="form-check-label" for="activoSwitchMenu">Activo</label>
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
