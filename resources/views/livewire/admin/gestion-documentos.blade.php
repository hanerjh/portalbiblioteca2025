<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Gestión de Documentos</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo Documento</button>
        </div>
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Buscar por título...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Autor</th>
                            <th>Visibilidad</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($documentos as $documento)
                        <tr>
                            <td>
                                <a href="{{ asset('storage/' . $documento->archivo_ruta) }}" target="_blank">{{ $documento->titulo }} <i class="bi bi-box-arrow-up-right small"></i></a>
                            </td>
                            <td>{{ $documento->categoria->nombre }}</td>
                            <td>{{ $documento->autor ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $documento->publico ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $documento->publico ? 'Público' : 'Privado' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $documento->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $documento->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No se encontraron documentos.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">{{ $documentos->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $documento_id ? 'Editar Documento' : 'Nuevo Documento' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" wire:model="titulo" class="form-control" id="titulo">
                            @error('titulo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Archivo</label>
                            <input type="file" wire:model="archivo" class="form-control" id="archivo">
                             <div wire:loading wire:target="archivo" class="text-primary small mt-1">Cargando...</div>
                            @if($documento_id) <small class="form-text text-muted">Dejar en blanco para no modificar el archivo actual.</small> @endif
                            @error('archivo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select wire:model="categoria_id" class="form-select" id="categoria_id">
                                    <option value="">Seleccionar...</option>
                                    @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" wire:model="autor" class="form-control" id="autor">
                                @error('autor') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Visibilidad</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model="publico" value="1" id="publicoSi">
                                <label class="form-check-label" for="publicoSi">Público</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" wire:model="publico" value="0" id="publicoNo">
                                <label class="form-check-label" for="publicoNo">Privado</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary" wire:click="store">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;"></div>
</div>
