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

    <button wire:click="actualizarOrdenar" class="btn btn-primary mt-3">Guardar Orden</button>
</div>

@push('script')

<!-- CSS del tema base -->
<link rel="stylesheet"
      href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI (necesario para sortable) -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>




<script>
    window.addEventListener('livewire:init', () => {
        console.log("🟢 Livewire inicializado");

        
            console.log("🔁 Re-render de Livewire - Inicializando sortable");

            $('#sortable').sortable({
                update: function () {
                    let orden = $(this).sortable('toArray', { attribute: 'data-id' });
                    Livewire.dispatch('actualizarOrden', { nuevaLista: orden });
                }
            });
       
    });
</script>



@endpush
