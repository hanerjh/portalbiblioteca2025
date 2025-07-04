<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Gestión de Material de Apoyo</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo Material</button>
        </div>
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Buscar por título...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materiales as $material)
                        <tr>
                            <td>{{ $material->titulo }}</td>
                            <td>{{ ucfirst($material->tipo) }}</td>
                            <td>{{ $material->categoria->nombre }}</td>
                            <td>
                                <span class="badge {{ $material->estado == 'publicado' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($material->estado) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $material->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $material->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">No se encontró material de apoyo.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">{{ $materiales->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $material_id ? 'Editar Material' : 'Nuevo Material de Apoyo' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="col-md-4 mb-3">
                                <label for="categoria_id" class="form-label">Asignar material al Recurso Digital:</label><br>
                                
                                <select wire:model="recurso_id" class="form-select" >
                                    <option value="">Seleccionar...</option>
                                    @foreach($recursodigital as $recdig)
                                    <option value="{{ $recdig->id }}">{{ $recdig->titulo }}</option>
                                    @endforeach
                                </select>
                                @error('recurso_id') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" wire:model="titulo" class="form-control">
                            @error('titulo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        

                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions"  id="inlineRadio1" value="1" wire:model.live="validarcampo" wire:click="mostrarCampo">
                            <label class="form-check-label" for="inlineRadio1">Subir archivo</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions"  id="inlineRadio2" value="2" wire:model.live="validarcampo" wire:click="mostrarCampo">
                            <label class="form-check-label" for="inlineRadio2">Enlace</label>
                
                            </div>
                        
                        {{-- @if ($validarcampo==2) --}}

                            
                        {{-- campo fileupload --}}
                        <div wire:show='e2' class="mb-3">
                            <label for="url_recurso" class="form-label">URL del Recurso</label>
                            <input type="text" wire:model="url_recurso" class="form-control {{ $d2 }}" placeholder="URL de video, ruta de archivo, etc.">
                             @error('url_recurso') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        {{-- @elseif($validarcampo==1) --}}

                          
                        {{-- campo fileupload --}}
                        <div wire:show='e1' class="mb-3">
                            <label for="archivo" class="form-label">Archivo</label>
                            <input type="file" wire:model="archivo" class="form-control {{ $d1 }}" id="archivo">
                             <div wire:loading wire:target="archivo" class="text-primary small mt-1">Cargando...</div>
                            @if($material_id) <small class="form-text text-muted">Dejar en blanco para no modificar el archivo actual.</small> @endif
                            @error('archivo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    {{-- @endif --}}

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select wire:model="tipo" class="form-select">
                                    <option value="videotutorial">Videotutorial</option>
                                    <option value="manual">Manual</option>
                                    <option value="guia">Guía</option>
                                    <option value="infografia">Infografía</option>
                                    <option value="documento">Documento</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select wire:model="categoria_id" class="form-select">
                                    <option value="">Seleccionar...</option>
                                    @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                        </div>
                        <div class="row">
                              <div class="col-md-4 mb-3">
                                <label for="idioma" class="form-label">Idioma</label>
                                <select wire:model="estado" class="form-select">
                                    <option value="es">Español</option>
                                    <option value="en">Inglés</option>
                                    <option value="pt">Portugués</option>
                                    <option value="fr">Francés</option>
                                    <option value="it">Italiano</option>
                                    <option value="ot">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select wire:model="estado" class="form-select">
                                    <option value="Borrador">Borrador</option>
                                    <option value="Publicado">Publicado</option>
                                    <option value="Archivado">Archivado</option>
                                </select>
                            </div>
                        </div>
                         <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea wire:model="descripcion" class="form-control" rows="4"></textarea>
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
