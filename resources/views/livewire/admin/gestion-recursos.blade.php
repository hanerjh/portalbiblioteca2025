<div>
    
    @push('script')
    <script src="assets/choices/scripts/choices.min.js"></script>
        <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/static/js/pages/simple-datatables.js"></script>
    @endpush

    @push('css')
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
        <link rel="stylesheet" href="assets/compiled/css/table-datatable.css">
    <!-- Include base CSS (optional) -->
    <link rel="stylesheet" href="assets/choices/styles/base.min.css"/>
    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="assets/choices/styles/choices.min.css"/>
   
    @endpush
        
            
    <div class="card">
        <div class="card-header d-flex ">
            <div class="flex-grow-1">

                <h5 class="card-title mb-0">Gestión de Recursos Digitales</h5>
            </div>
            <div class="justify-content-end">
                <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo Recurso</button>
                <a href="{{ route('recursosorteable.index') }}" class="btn btn-warning"><i class="bi bi-arrows-collapse me-1"></i> Ordenar Recurso</a>
            </div>
        </div>
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Buscar por título...">
            <div class="table-responsive" >
                <table class="table table-striped table-hover" >
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th>Tipo de Acceso</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recursos as $recurso)
                        <tr>
                            <td>{{ $recurso->titulo }}</td>
                            <td>{{ $recurso->categoria->nombre }}</td>
                            <td>{{ $recurso->proveedor ?? 'N/A' }}</td>
                            <td>
                                <span class="badge {{ $recurso->tipo_acceso == 'libre' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($recurso->tipo_acceso) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <button wire:click="edit({{ $recurso->id }})" class="btn btn-sm btn-info" title="Editar"><i class="bi bi-pencil"></i></button>
                                <button wire:click="delete({{ $recurso->id }})" wire:confirm="¿Estás seguro?" class="btn btn-sm btn-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron recursos digitales.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $recursos->links() }}</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" style="display: @if($isOpen) block @else none @endif;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $recurso_id ? 'Editar Recurso' : 'Nuevo Recurso Digital' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" wire:model="titulo" class="form-control" id="titulo">
                            @error('titulo') <span class="text-danger small">{{ $message }}</span> @enderror
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
                                <label for="tipo_acceso" class="form-label">Tipo de Acceso</label>
                                <select wire:model="tipo_acceso" class="form-select" id="tipo_acceso">
                                    <option value="Acceso abierto">Acceso abierto</option>
                                    <option value="restringido">Restringido</option>
                                    <option value="suscripcion">Suscripción</option>
                                </select>
                                @error('tipo_acceso') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row" wire:ignore>
                            <div class="col-md-6 mb-3">
                                <label for="tipousuario" class="form-label">Tipo Usuario</label>
                                <select class="choices form-select multiple-remove" multiple="multiple" id="tipousuario">
                                    <option value="">Seleccionar...</option>
                                    @foreach($tipoUsuarios as $tpusu)
                                    <option value="{{ $tpusu->id }}">{{ $tpusu->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_usuario') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">Área Conocimiento</label>
                                <select class="choices form-select multiple-remove" multiple="multiple" id="areaconocimiento">
                                    <option value="">Seleccionar...</option>
                                    @foreach($area as $areaconocimiento)
                                    <option value="{{ $areaconocimiento->id }}">{{ $areaconocimiento->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('area_conocimiento') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3" wire:ignore>
                                <label for="programa" class="form-label">Programa Académico</label>
                                <select class="choices form-select multiple-remove" multiple="multiple" id="programa">
                                    <option value="">Seleccionar...</option>
                                    @foreach($programa as $prog)
                                    <option value="{{ $prog->id }}">{{ $prog->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('programa') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="proveedor" class="form-label">Proveedor</label>
                                <input type="text" wire:model="proveedor" class="form-control" id="proveedor">
                                @error('proveedor') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL de Acceso</label>
                            <input type="url" wire:model="url" class="form-control" id="url" placeholder="https://...">
                            @error('url') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
                            @error('descripcion') <span class="text-danger small">{{ $message }}</span> @enderror
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

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Instancias de Choices.js
    let choicesInstances = {};
    
    // Configuración de selects
    const selectsConfig = [
        { id: 'tipousuario', evento: 'tiposActualizados' },
        { id: 'areaconocimiento', evento: 'areasActualizadas' },
        { id: 'programa', evento: 'programaActualizadas' }
    ];

    // Inicializar Choices.js
    function initializeChoices() {
        selectsConfig.forEach(({ id, evento }) => {
            const element = document.getElementById(id);
            if (element) {
                // Destruir instancia existente si existe
                if (choicesInstances[id]) {
                    choicesInstances[id].destroy();
                }
                
                // Crear nueva instancia
                choicesInstances[id] = new Choices(element, {
                    removeItemButton: true,
                    searchEnabled: true,
                    searchChoices: true,
                    placeholder: true,
                    placeholderValue: 'Seleccionar...',
                    allowHTML: false
                });
                
                // Agregar event listener
                element.addEventListener('change', () => {
                    const selectedValues = choicesInstances[id].getValue(true);
                    console.log(`${id} seleccionados:`, selectedValues);
                    Livewire.dispatch(evento, { seleccionados: selectedValues });
                });
            }
        });
    }

    // Limpiar todos los selects
    function limpiarSelects() {
        console.log('Limpiando selects...');
        selectsConfig.forEach(({ id }) => {
            if (choicesInstances[id]) {
                // Limpiar selecciones actuales
                choicesInstances[id].removeActiveItems();
                console.log(`Select ${id} limpiado`);
            }
        });
    }

    // Cargar valores en los selects (para edición)
    function cargarValoresSelects(data) {
        console.log('Cargando valores:', data);
        
        // Cargar tipos de usuario
        if (data.tipos && data.tipos.length > 0 && choicesInstances['tipousuario']) {
            choicesInstances['tipousuario'].setChoiceByValue(data.tipos.map(String));
        }
        
        // Cargar áreas de conocimiento
        if (data.areas && data.areas.length > 0 && choicesInstances['areaconocimiento']) {
            choicesInstances['areaconocimiento'].setChoiceByValue(data.areas.map(String));
        }
        
        // Cargar programas
        if (data.programas && data.programas.length > 0 && choicesInstances['programa']) {
            choicesInstances['programa'].setChoiceByValue(data.programas.map(String));
        }
    }

    // Función para verificar si el modal está abierto
    function isModalOpen() {
        return document.querySelector('.modal.show') !== null;
    }

    // Inicializar cuando se detecte que el modal está abierto
    function checkAndInitialize() {
        if (isModalOpen() && Object.keys(choicesInstances).length === 0) {
            initializeChoices();
        }
    }

    // Observer para detectar cambios en el DOM
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                const target = mutation.target;
                if (target.classList.contains('modal') && target.classList.contains('show')) {
                    setTimeout(() => {
                        checkAndInitialize();
                    }, 100);
                }
            }
        });
    });

    // Observar cambios en el modal
    const modal = document.querySelector('.modal');
    if (modal) {
        observer.observe(modal, { attributes: true });
    }

    // Escuchar eventos personalizados
    window.addEventListener('limpiar-selects', function() {
        console.log('Evento personalizado limpiar-selects recibido');
        if (isModalOpen()) {
            setTimeout(() => {
                if (Object.keys(choicesInstances).length === 0) {
                    initializeChoices();
                }
                limpiarSelects();
            }, 100);
        }
    });

    window.addEventListener('cargar-valores-selects', function(event) {
        console.log('Evento personalizado cargar-valores-selects recibido', event.detail);
        if (isModalOpen()) {
            setTimeout(() => {
                if (Object.keys(choicesInstances).length === 0) {
                    initializeChoices();
                }
                setTimeout(() => {
                    cargarValoresSelects(event.detail);
                }, 100);
            }, 100);
        }
    });

    // Inicializar al cargar la página si el modal ya está abierto
    setTimeout(() => {
        checkAndInitialize();
    }, 100);
});
</script>
@endpush