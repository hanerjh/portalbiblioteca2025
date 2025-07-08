<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <ul id="sortable" class="list-group" wire:ignore>
        @foreach ($recursos as $recurso)
            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $recurso['id'] }}">
                {{ $recurso['titulo'] }}
                <span class="badge bg-secondary">#{{ $reloop = $loop->index + 1 }}</span>
            </li>
        @endforeach
    </ul>

    {{-- <button wire:click="actualizarOrden" class="btn btn-primary mt-3">Guardar Orden</button> --}}
</div>
 

@push('script')



<!-- jQuery UI desde cdnjs, después de jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- Script para Livewire + Sortable -->
<script>
    function initSortable() {
        const $el = $('#sortable');

        if (typeof $.ui === 'undefined' || typeof $.ui.sortable !== 'function') {
            console.error('⛔ jQuery UI sortable NO está disponible');
            return;
        }

        if ($el.data('ui-sortable')) $el.sortable('destroy');

        $el.sortable({
            update: function () {
                let orden = $el.sortable('toArray', { attribute: 'data-id' });
                console.log(orden);
                //Livewire.dispatch('actualizarOrden2');
                Livewire.dispatch('actualizarOrden', { nuevaLista: orden });
            }
        });

        console.log("✅ Sortable activado");
    }

    window.addEventListener('livewire:init', () => {
        console.log("🟢 Livewire iniciado");
        initSortable();
    });

    Livewire.hook('commit', ({ succeed }) => {
        succeed(() => {
            queueMicrotask(() => {
                console.log("🔁 Livewire re-render – reinicializando sortable");
                initSortable();
            });
        });
    });
</script>

@endpush
