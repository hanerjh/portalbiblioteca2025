<div>
   @include('partials.includes')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title mb-0">Gestión de Publicaciones</h5>
                <small class="text-muted">Administra las noticias, anuncios y convocatorias.</small>
            </div>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nueva Publicación</button>
        </div>
        <div class="card-body">
            <!--<div class="row mb-3">
                <div class="col-md-6">
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Buscar por título...">
                </div>
            </div>-->
            <div class="table-responsive" wire:ignore>
                <table class="table table-striped table-hover"  id="table1">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Fecha Creación</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publicaciones as $publicacion)
                        <tr>
                            <td>{{ $publicacion->titulo }}</td>
                            <td>{{ $publicacion->categoria->nombre }}</td>
                            <td >
                                <span class="badge {{ $publicacion->estado == 'publicado' ? 'bg-success' : ($publicacion->estado == 'borrador' ? 'bg-warning' : 'bg-secondary') }}">
                                    {{ ucfirst($publicacion->estado) }}
                                </span>
                            </td>
                            <td>{{ $publicacion->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <button wire:click="edit({{ $publicacion->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $publicacion->id }})" wire:confirm="¿Estás seguro de que quieres eliminar esta publicación?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron publicaciones.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="mt-3">
                {{ $publicaciones->links() }}
            </div>
        </div>
    </div>

    <!-- Modal para Crear/Editar -->
    <div class="modal fade @if($isOpen)  show @endif"  style="display: @if($isOpen) block @else none @endif;" tabindex="-1" role="dialog">
   
        <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content"> 
                <div class="modal-header">
                    <h5 class="modal-title">{{ $publicacion_id ? 'Editar Publicación' : 'Crear Nueva Publicación' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
                </div>               
                 <div class="modal-body">
                   
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select wire:model="categoria_id" class="form-select" id="categoria_id">
                                    <option value="">Selecciona una categoría</option>
                                    @foreach($categorias as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('categoria_id') <span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                         <div class="col-md-6 mb-3">

                                <label for="slug" class="form-label">Slug (URL amigable)</label>
                                <input type="text" wire:model="slug" class="form-control bg-light" id="slug" readonly>
                                @error('slug') <span class="text-danger small">{{ $message }}</span>@enderror
                        
                            </div>
                     
                        </div>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" wire:model="titulo" wire:keyup="actualizarTitulo" class="form-control" id="titulo">
                            @error('titulo') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Archivo</label>
                            <input type="file" wire:model="archivo" class="form-control" id="archivo">
                             <div wire:loading wire:target="archivo" class="text-primary small mt-1">Cargando...</div>
                            @if($publicacion_id) <small class="form-text text-muted">Dejar en blanco para no modificar el archivo actual.</small> @endif
                            @error('archivo') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                         
             <div class="mb-3">
                            <label for="resumen" class="form-label">Resumen</label>
                            <textarea wire:model="resumen" class="form-control" id="resumen" rows="3"></textarea>
                            @error('resumen') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="contenido" class="form-label">Contenido Completo</label>
                          
                         <div
                            x-data
                            x-init="
                                let editor = $('#editor').summernote({
                                    height: 200,
                                    callbacks: {
                                        onChange: function(contents) {
                                            $wire.set('contenido', contents);
                                        }
                                    }
                                });

                                // Si ya hay contenido, establecerlo al cargar
                                $nextTick(() => {
                                    $('#editor').summernote('code', @js($contenido));
                                });  
                            "
                            wire:ignore
                        >
    <textarea id="editor"></textarea>
</div>

                             @error('contenido') <span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
     
                        <div class="row">
                             <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select wire:model="estado" class="form-select" id="estado">
                                    <option value="Borrador">Borrador</option>
                                    <option value="Publicado">Publicado</option>
                                    <option value="Archivado">Archivado</option>
                                </select>
                                @error('estado') <span class="text-danger small">{{ $message }}</span>@enderror
                            </div>
                               <div class="col-md-6 mb-3">
                                <label class="form-label">Publicación Destacado</label>
                                <div class="form-check form-switch">
                                    
                                    <input class="form-check-input" type="checkbox" role="switch" id="activaSwitch" wire:model="destacado" wire:click="chage_destacado">
                                    <label class="form-check-label" for="activaSwitch">{{ $label_destacado ?? 'Inactiva' }}</label>
                                </div>
                        </div>
                        </div>

                        <!-- inicio acordion para ocultar campos url de videos y audio-->
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item ">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Insertar enlace de medios videos o audio
                                    </button>
                                </h2>

                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="video" class="form-label">URL Video</label>
                                    <input type="url" wire:model="video" class="form-control" id="video">
                                    @error('video') <span class="text-danger small">{{ $message }}</span>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="audio" class="form-label">URL Audio</label>
                                    <input type="text" wire:model="audio" class="form-control" id="audio">
                                    @error('audio') <span class="text-danger small">{{ $message }}</span>@enderror
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>             
               <!-- fin acordion para ocultar campos url de videos y audio--> 
                         
                    </form>
                 </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal()">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Guardar Cambios</button>
                </div>
            </div>
        </div> 
    </div>
    <div class="modal-backdrop fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;"></div>

</div>

