<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                 <a href="{{ route('menus.index') }}" class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-arrow-left"></i> Volver</a>
                <h5 class="card-title mb-0 d-inline-block">Items del Menú: <strong>{{ $menu->nombre }}</strong></h5>
            </div>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo Item</button>
        </div>
        <div class="card-body">
            <div class="list-group">
                @forelse($items as $item)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1"><i class="bi bi-arrows-move"></i> {{ $item->titulo }} <small class="text-muted">({{ $item->url }})</small></h6>
                            <div>
                                <button wire:click="create({{ $item->id }})" class="btn btn-sm btn-success" title="Añadir Sub-item"><i class="bi bi-plus"></i></button>
                                <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $item->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <span class="badge {{ $item->activo ? 'bg-success' : 'bg-secondary' }}">{{ $item->activo ? 'Activo' : 'Inactivo' }}</span>
                        
                        @if($item->children->isNotEmpty())
                            <div class="list-group mt-3 ms-4">
                                @foreach($item->children as $child)
                                <div class="list-group-item list-group-item-action">
                                     <div class="d-flex w-100 justify-content-between">
                                        <p class="mb-1"><i class="bi bi-arrow-return-right"></i> {{ $child->titulo }} <small class="text-muted">({{ $child->url }})</small></p>
                                        <div>
                                            <button wire:click="edit({{ $child->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                            <button wire:click="delete({{ $child->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-center">Este menú aún no tiene items.</p>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $item_id ? 'Editar Item' : 'Nuevo Item de Menú' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" wire:model="titulo" class="form-control">
                            @error('titulo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">icono</label>
                            <input type="text" wire:model="icono" class="form-control">
                            @error('icono') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                         <div class="mb-3">
                            <label for="url" class="form-label">URL o Ruta</label>
                            <input type="text" wire:model="url" class="form-control">
                            @error('url') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Elemento Padre (opcional)</label>
                            <select wire:model="parent_id" class="form-select">
                                <option value="">Ninguno (Es principal)</option>
                                @foreach($potential_parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->titulo }}</option>
                                @endforeach
                            </select>
                          {{ $parent_id }}
                        </div>
                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="activoItemSwitch" wire:model="activo">
                            <label class="form-check-label" for="activoItemSwitch">Activo</label>
                        </div>
                         <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="targetBlankSwitch" wire:model="target_blank">
                            <label class="form-check-label" for="targetBlankSwitch">Abrir en nueva pestaña</label>
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
