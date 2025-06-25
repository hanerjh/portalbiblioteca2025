<div>
    
    @push('script')
        <script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
        <script src="assets/static/js/pages/form-element-select.js"></script>
    @endpush

    @push('css')
        <link rel="stylesheet" href="assets/extensions/choices.js/public/assets/styles/choices.css">
        
    @endpush
        
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Gestión de Recursos Digitales</h5>
            <button wire:click="create()" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Nuevo Recurso</button>
        </div>
        <div class="card-body">
            <input wire:model.live.debounce.300ms="search" type="text" class="form-control mb-3" placeholder="Buscar por título...">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
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
                                    <option value="libre">Libre</option>
                                    <option value="restringido">Restringido</option>
                                    <option value="suscripcion">Suscripción</option>
                                </select>
                                @error('tipo_acceso') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row" wire:ignore>
                            <div class="col-md-6 mb-3">
                                <label for="tipousuario" class="form-label">Tipo Usuario</label>
                                <select  class="choices form-select multiple-remove" multiple="multiple" id="tipousuario">
                                    <option value="">Seleccionar...</option>
                                    @foreach($tipoUsuarios as $tpusu)
                                    <option value="{{ $tpusu->id }}">{{ $tpusu->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_usuario') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                    <label for="area" class="form-label">Área Conocimiento</label>
                                    <select  class="choices form-select multiple-remove" multiple="multiple" id="areaconocimiento">
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
                                    <select  class="choices form-select multiple-remove" multiple="multiple" id="programa">
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

{{-- @push('script')
<script>
document.addEventListener('alpine:init', () => {
    window.Livewire.hook('commit', () => {
        // Solo inicializa si no existe
        const tipoSelect = document.getElementById('tipousuario');
tipoSelect.addEventListener('change', function () {
    const seleccionados = Array.from(this.selectedOptions).map(opt => opt.value);
    console.log(seleccionados)
    Livewire.dispatch('tiposActualizados', {
        seleccionados: seleccionados
    });
});

const areaSelect = document.getElementById('areaconocimiento');
areaSelect.addEventListener('change', function () {
    const seleccionados = Array.from(this.selectedOptions).map(opt => opt.value);
    console.log(seleccionados)
    Livewire.dispatch('areasActualizadas', {
        seleccionados: seleccionados
    });
});

    });
});
</script>
@endpush --}}

@push('script')
<script>
    document.addEventListener('alpine:init', () => {
        window.Livewire.hook('commit', () => {
        const selects = [
            { id: 'tipousuario', evento: 'tiposActualizados' },
            { id: 'areaconocimiento', evento: 'areasActualizadas' },
            { id: 'programa', evento: 'programaActualizadas' }
        ];

        selects.forEach(({ id, evento }) => {
            const element = document.getElementById(id);
         
            element.addEventListener('change', () => {
                const selectedValues = Array.from(element.selectedOptions).map(option => option.value);
                console.log(selectedValues);
                Livewire.dispatch(evento, { seleccionados: selectedValues });
            });
        });
    });
    });
</script>
@endpush

